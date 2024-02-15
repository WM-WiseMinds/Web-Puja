<?php

namespace App\Livewire;

use App\Models\HistoryTabungan;
use App\Models\Sampah;
use App\Models\Tabungan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class SampahForm extends ModalComponent
{
    use Toastable;

    public Sampah $sampah;
    public $transaksi, $jenis_sampah, $nama_sampah, $harga_sampah, $jumlah_sampah, $transaksi_id;
    public $sampahItems = [];

    public function render()
    {
        $transaksi = Transaksi::all();
        return view('livewire.sampah-form', compact('transaksi'));
    }

    protected $rules = [
        'transaksi_id' => 'required|exists:transaksi,id',
        'jenis_sampah' => 'required',
        'nama_sampah' => 'required',
        'harga_sampah' => 'required|numeric|min:0',
        'jumlah_sampah' => 'required|numeric|min:0',
    ];

    public function addSampahItem()
    {
        $this->sampahItems[] = ['jenis_sampah' => '', 'nama_sampah' => '', 'harga_sampah' => '', 'jumlah_sampah' => ''];
    }

    public function removeSampahItem($index)
    {
        unset($this->sampahItems[$index]);
        $this->sampahItems = array_values($this->sampahItems);
    }

    public function resetCreateForm()
    {
        $this->reset(['transaksi_id', 'jenis_sampah', 'nama_sampah', 'harga_sampah', 'jumlah_sampah']);
    }

    public function store()
    {
        $validatedData = $this->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'sampahItems.*.jenis_sampah' => 'required',
            'sampahItems.*.nama_sampah' => 'required',
            'sampahItems.*.harga_sampah' => 'required|numeric|min:0',
            'sampahItems.*.jumlah_sampah' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $perubahanSaldo = 0;
            foreach ($this->sampahItems as $item) {
                $hargaTotalSampahSebelumnya = 0;
                if ($this->sampah->exists) {
                    // Updating an existing Sampah
                    $hargaTotalSampahSebelumnya = $this->sampah->jumlah_sampah * $this->sampah->harga_sampah;
                    $this->sampah->update($item);
                    $this->success('Sampah berhasil diubah');
                } else {
                    // Creating a new Sampah
                    $sampah = new Sampah();
                    $sampah->fill($item);
                    $sampah->transaksi_id = $this->transaksi_id;
                    $sampah->save();
                    $this->success('Sampah berhasil ditambahkan');
                }

                $hargaTotalSampahBaru = $item['harga_sampah'] * $item['jumlah_sampah'];
                $perubahanSaldo += ($hargaTotalSampahBaru - $hargaTotalSampahSebelumnya);
            }

            if ($perubahanSaldo != 0) {
                $tabungan = Tabungan::firstOrCreate([
                    'nasabah_id' => Transaksi::find($this->transaksi_id)->nasabah_id,
                ], [
                    'saldo' => 0,
                ]);

                $keterangan = 'Penjualan Sampah';
                if ($this->sampah->exists) {
                    $tabungan->updateSaldo($perubahanSaldo, 'debit', $keterangan, $this->sampah->created_at);
                } else {
                    $tabungan->createSaldo($perubahanSaldo, 'debit', $keterangan);
                }
                $this->success('Tabungan berhasil diperbarui');
            }


            DB::commit();

            $this->closeModalWithEvents([
                TransaksiTable::class => 'sampahUpdated',
            ]);

            $this->resetCreateForm();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Terjadi kesalahan' . $e->getMessage());
        }
    }

    public function mount($transaksi_id = null, $sampah_id = null)
    {
        $this->transaksi_id = $transaksi_id;
        $this->transaksi = Transaksi::all();

        if ($sampah_id) {
            // Editing an existing Sampah
            $this->sampah = Sampah::find($sampah_id);
            $this->sampahItems = [
                [
                    'jenis_sampah' => $this->sampah->jenis_sampah,
                    'nama_sampah' => $this->sampah->nama_sampah,
                    'harga_sampah' => $this->sampah->harga_sampah,
                    'jumlah_sampah' => $this->sampah->jumlah_sampah,

                ]
            ];
            $this->transaksi_id = $this->sampah->transaksi_id;
        } else {
            // Adding a new Sampah
            $this->sampah = new Sampah;
            $this->sampahItems = [];
        }
    }
}
