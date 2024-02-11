<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\Penukaran;
use App\Models\Tabungan;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class PenukaranForm extends ModalComponent
{
    use Toastable;

    public Penukaran $penukaran;
    public $tabungan, $barang, $tabungan_id, $barang_id;

    protected $rules = [
        'tabungan_id' => 'required|exists:tabungan,id',
        'barang_id' => 'required|exists:barang,id',
    ];

    public function render()
    {
        $tabungan = Tabungan::with('nasabah.user')->get();
        $barang = Barang::all();
        return view('livewire.penukaran-form', compact('tabungan', 'barang'));
    }

    public function resetCreateForm()
    {
        $this->reset(['tabungan_id', 'barang_id']);
    }

    public function store()
    {
        $validatedData = $this->validate();
        if (!$this->validateSaldoCukup()) {
            $this->error('Saldo tidak cukup untuk melakukan penukaran');
            return;
        }

        $this->penukaran->fill($validatedData);
        $this->penukaran->save();
        $this->success($this->penukaran->wasRecentlyCreated ? 'Penukaran berhasil ditambahkan' : 'Penukaran berhasil diubah');

        $tabungan = Tabungan::find($this->penukaran->tabungan_id);

        $harga = $this->penukaran->barang->harga_barang;
        $tabungan->updateSaldo($harga, 'kredit', 'Penukaran barang');
        $this->success('Saldo berhasil dikurangi');

        $this->closeModalWithEvents([
            PenukaranTable::class => 'penukaranUpdated'
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        $this->barang = Barang::all();
        $this->tabungan = Tabungan::with('nasabah.user')->get();
        $this->penukaran = $rowId ? Penukaran::find($rowId) : new Penukaran;
        if ($this->penukaran->exists) {
            $this->tabungan_id = $this->penukaran->tabungan_id;
            $this->barang_id = $this->penukaran->barang_id;
        }
    }

    public function validateSaldoCukup()
    {
        $tabungan = Tabungan::find($this->tabungan_id);
        $barang = Barang::find($this->barang_id);

        if ($tabungan->saldo < $barang->harga_barang) {
            return false;
        }

        return true;
    }
}
