<?php

namespace App\Livewire;

use App\Models\HistoryTabungan;
use App\Models\JenisSampah;
use App\Models\Sampah;
use App\Models\Tabungan;
use App\Models\Transaksi;
use Exception;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class SampahForm extends ModalComponent
{
    use Toastable;

    public Sampah $sampah;
    public $id, $transaksi, $jenis_sampah, $jenis_sampah_id, $nama_sampah, $harga_sampah, $jumlah_sampah, $transaksi_id;
    public $sampahItems = [];

    public function mount($transaksi_id = null, $sampah_id = null)
    {
        $this->sampah = Sampah::findOrNew($sampah_id);
        $this->jenis_sampah = JenisSampah::where('status', 'Aktif')->get();
        $this->transaksi_id = $transaksi_id ? $transaksi_id : $this->sampah->transaksi_id;
        $this->transaksi = Transaksi::find($this->transaksi_id);
        if ($this->sampah->exists) {
            $this->sampahItems = [
                [
                    'jenis_sampah_id' => $this->sampah->jenis_sampah_id,
                    'nama_sampah' => $this->sampah->nama_sampah,
                    'harga_sampah' => $this->sampah->harga_sampah,
                    'jumlah_sampah' => $this->sampah->jumlah_sampah,
                ]
            ];
        } else {
            $this->sampahItems = [];
        }
    }

    public function rules()
    {
        return [
            'transaksi_id' => 'required|exists:transaksi,id',
            'sampahItems.*.jenis_sampah_id' => 'required|exists:jenis_sampah,id',
            'sampahItems.*.nama_sampah' => 'required',
            'sampahItems.*.harga_sampah' => 'required|numeric|min:0',
            'sampahItems.*.jumlah_sampah' => 'required|numeric|min:0',
        ];
    }

    public function addSampahItem()
    {
        $this->sampahItems[] = ['jenis_sampah_id' => '', 'nama_sampah' => '', 'harga_sampah' => '', 'jumlah_sampah' => ''];
    }

    public function removeSampahItem($index)
    {
        unset($this->sampahItems[$index]);
        $this->sampahItems = array_values($this->sampahItems);
    }

    public function updateHargaSampah($index)
    {
        $jenisSampahId = $this->sampahItems[$index]['jenis_sampah_id'];
        $jenisSampah = JenisSampah::find($jenisSampahId);
        $this->sampahItems[$index]['harga_sampah'] = $jenisSampah->harga;
    }

    public function resetForm()
    {
        $this->reset(['transaksi_id']);
        $this->sampah = new Sampah();
        $this->sampahItems = [['jenis_sampah_id' => '', 'nama_sampah' => '', 'harga_sampah' => '', 'jumlah_sampah' => '']];
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $perubahanSaldo = 0;
            foreach ($this->sampahItems as $item) {
                if ($this->sampah->id) {
                    $sampah = Sampah::find($this->sampah->id);
                    $hargaSebelumnya = $sampah->harga_sampah;
                    $jumlahSebelumnya = $sampah->jumlah_sampah;
                } else {
                    $hargaSebelumnya = 0;
                    $jumlahSebelumnya = 0;
                }

                $sampah = Sampah::updateOrCreate(
                    ['id' => $this->sampah->id],
                    array_merge($item, ['transaksi_id' => $this->transaksi_id])
                );

                $hargaTotalSampahSebelumnya = $hargaSebelumnya * $jumlahSebelumnya;
                $hargaTotalSampahBaru = $item['harga_sampah'] * $item['jumlah_sampah'];

                $perubahanSaldo += $hargaTotalSampahBaru - $hargaTotalSampahSebelumnya;
            }

            $tabungan = Tabungan::firstOrCreate([
                'nasabah_id' => Transaksi::find($this->transaksi_id)->nasabah_id,
            ], [
                'saldo' => 0,
            ]);

            if ($perubahanSaldo != 0) {
                $keterangan = 'Penjualan Sampah - Transaksi #' . $this->transaksi->kode_transaksi;
                $operation = $perubahanSaldo > 0 ? 'increment' : 'decrement';
                $tabungan->updateSaldo(abs($perubahanSaldo), 'debit', $operation, $keterangan, now());
                $this->success('Tabungan berhasil diperbarui');
            }


            DB::commit();

            $this->closeModalWithEvents([
                TransaksiTable::class => 'sampahUpdated',
            ]);

            $this->resetForm();
            $this->success('Data sampah berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.sampah-form');
    }
}
