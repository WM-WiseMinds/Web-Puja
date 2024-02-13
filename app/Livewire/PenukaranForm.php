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
    public $tabungan, $barang, $tabungan_id, $barang_id, $saldo, $harga;

    protected $rules = [
        'tabungan_id' => 'required|exists:tabungan,id',
        'barang_id' => 'required|exists:barang,id',
    ];

    public function render()
    {
        $tabungan = Tabungan::with('nasabah.user')->get();
        $barang = Barang::where('status', 'Aktif')->get();
        return view('livewire.penukaran-form', compact('tabungan', 'barang'));
    }

    public function resetCreateForm()
    {
        $this->reset(['tabungan_id', 'barang_id']);
    }

    public function store()
    {
        $validatedData = $this->validate();
        if (!$this->validateData()) {
            // $this->error('Saldo tidak cukup untuk melakukan penukaran');
            return;
        }

        $barang = Barang::find($this->barang_id);
        $this->penukaran->fill($validatedData);
        $this->penukaran->harga_barang_saat_tukar = $barang->harga_barang;
        $this->penukaran->save();
        $this->success($this->penukaran->wasRecentlyCreated ? 'Penukaran berhasil ditambahkan' : 'Penukaran berhasil diubah');

        // Kurangi stok barang
        $barang->stok_barang -= 1;
        $barang->save();

        $tabungan = Tabungan::find($this->penukaran->tabungan_id);
        $harga = $this->penukaran->barang->harga_barang;
        $created_at = $this->penukaran->created_at;
        if ($this->penukaran->wasRecentlyCreated) {
            // dd($this->penukaran->wasRecentlyCreated);
            $tabungan->createSaldo($harga, 'kredit', 'Penukaran barang');
        } else {
            $tabungan->updateSaldo($harga, 'kredit', 'Penukaran barang', $created_at);
        }

        $this->success('Saldo berhasil dikurangi');

        $this->closeModalWithEvents([
            PenukaranTable::class => 'penukaranUpdated'
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        $this->barang = Barang::where('status', 'Aktif')->get();
        $this->tabungan = Tabungan::with('nasabah.user')->where('status', 'Aktif')->get();
        $this->penukaran = $rowId ? Penukaran::find($rowId) : new Penukaran;
        if ($this->penukaran->exists) {
            $this->tabungan_id = $this->penukaran->tabungan_id;
            $this->barang_id = $this->penukaran->barang_id;
        }
    }

    public function validateData()
    {
        $tabungan = Tabungan::find($this->tabungan_id);
        $barang = Barang::find($this->barang_id);

        if ($tabungan->saldo < $barang->harga_barang) {
            $this->error('Saldo tidak cukup untuk melakukan penukaran');
            return false;
        }

        if ($barang->stok_barang <= 0) {
            $this->error('Barang yang dipilih sedang kosong');
            return false;
        }

        return true;
    }
}
