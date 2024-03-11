<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\HistoryTabungan;
use App\Models\Penukaran;
use App\Models\Tabungan;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class PenukaranForm extends ModalComponent
{
    use Toastable;

    public Penukaran $penukaran;
    public $id, $tabungan, $barang, $tabungan_id, $barang_id, $saldo, $harga_barang, $kode_penukaran;

    public function mount($rowId = null)
    {
        $this->penukaran = Penukaran::findOrNew($rowId);
        $this->tabungan = Tabungan::where('status', 'aktif')->get();
        $this->barang = Barang::where('status', 'aktif')->where('stok_barang', '>', 0)->get();
        $this->id = $this->penukaran->id;
        $this->tabungan_id = $this->penukaran->tabungan_id;
        $this->barang_id = $this->penukaran->barang_id;
        $this->saldo = $rowId ? $this->penukaran->tabungan->saldo : '';
        $this->harga_barang = $this->penukaran->harga_barang;
    }

    public function generateKodePenukaran()
    {
        $prefix = 'TKR';
        $length = 8;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        do {
            $kodePenukaran = $prefix;
            for ($i = 0; $i < $length; $i++) {
                $kodePenukaran .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while (Penukaran::where('kode_penukaran', $kodePenukaran)->exists());

        return $kodePenukaran;
    }

    public function updateSaldo()
    {
        $tabungan = Tabungan::find($this->tabungan_id);
        $this->saldo = $tabungan->saldo;
    }

    public function updateHarga()
    {
        $barang = Barang::find($this->barang_id);
        $this->harga_barang = $barang->harga_barang;
    }

    public function rules()
    {
        return [
            'tabungan_id' => 'required|exists:tabungan,id',
            'barang_id' => 'required|exists:barang,id',
            'harga_barang' => 'required|numeric|min:0',
        ];
    }

    public function resetForm()
    {
        $this->reset('tabungan_id', 'barang_id', 'saldo', 'harga_barang', 'kode_penukaran');
    }

    public function store()
    {
        $validatedData = $this->validate();

        $tabungan = Tabungan::find($this->tabungan_id);
        $barang = Barang::find($this->barang_id);

        if ($tabungan->saldo < $barang->harga_barang) {
            $this->error('Saldo tabungan tidak mencukupi');
            return;
        }

        if (!$this->penukaran->exists) {
            $validatedData['kode_penukaran'] = $this->generateKodePenukaran();
        }

        $penukaranSebelumnya = $this->penukaran->replicate();
        $this->penukaran = Penukaran::updateOrCreate(['id' => $this->id], $validatedData);

        if ($penukaranSebelumnya->exists && $penukaranSebelumnya->barang_id !== $this->barang_id) {
            $barangSebelumnya = $penukaranSebelumnya->barang;
            $barangSebelumnya->increment('stok_barang');

            $keteranganPenukaranSebelumnya = 'Penukaran Barang - Penukaran #' . $penukaranSebelumnya->kode_penukaran;
            $historyTabunganSebelumnya = HistoryTabungan::where('tabungan_id', $tabungan->id)
                ->where('keterangan', $keteranganPenukaranSebelumnya)
                ->first();

            if ($historyTabunganSebelumnya) {
                $historyTabunganSebelumnya->delete();
            }
        }

        $barang->decrement('stok_barang');

        $keteranganPenukaran = 'Penukaran Barang - Penukaran #' . $this->penukaran->kode_penukaran;
        $historyTabungan = HistoryTabungan::where('tabungan_id', $tabungan->id)
            ->where('keterangan', $keteranganPenukaran)
            ->first();

        if ($historyTabungan) {
            $historyTabungan->kredit = $this->harga_barang;
            $historyTabungan->save();
        } else {
            $tabungan->updateSaldo($this->harga_barang, 'kredit', 'increment', $keteranganPenukaran);
        }

        $this->success('Penukaran barang berhasil dilakukan');
        $this->closeModalWithEvents([
            PenukaranTable::class => 'penukaranUpdated',
        ]);
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.penukaran-form');
    }
}
