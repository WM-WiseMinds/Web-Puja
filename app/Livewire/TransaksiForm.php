<?php

namespace App\Livewire;

use App\Models\Nasabah;
use App\Models\Tabungan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class TransaksiForm extends ModalComponent
{
    use Toastable;

    public Transaksi $transaksi;
    public $user, $user_id, $nasabah, $nasabah_id, $tgl_transaksi, $total_sampah, $total_berat, $total_harga, $status;

    protected $rules = [
        'nasabah_id' => 'required|exists:nasabah,id',
        'total_berat' => 'required|numeric|min:0',
        'status' => 'required',
    ];

    public function render()
    {
        $transaksi = Transaksi::all();
        $nasabah = Nasabah::where('status', 'Aktif')->get();
        $user = User::all();
        return view('livewire.transaksi-form', compact('transaksi', 'nasabah', 'user'));
    }

    public function resetCreateForm()
    {
        $this->reset(['nasabah_id', 'tgl_transaksi', 'total_sampah', 'total_berat', 'total_harga', 'status']);
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = auth()->id();

        // Get the original nasabah_id before the update
        $originalNasabahId = $this->transaksi->nasabah_id;

        $this->transaksi->fill($validatedData);
        $this->transaksi->save();

        // If the nasabah_id has been updated
        if ($originalNasabahId !== $this->transaksi->nasabah_id) {
            // Update the nasabah_id in the Tabungan
            $tabungan = Tabungan::where('nasabah_id', $originalNasabahId)->first();
            if ($tabungan) {
                $tabungan->nasabah_id = $this->transaksi->nasabah_id;
                $tabungan->save();
            }
        }

        $this->success($this->transaksi->wasRecentlyCreated ? 'Transaksi berhasil ditambahkan' : 'Transaksi berhasil diubah');

        $this->closeModalWithEvents([
            TransaksiTable::class => 'transaksiUpdated',
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        $this->user = User::all();
        $this->nasabah = Nasabah::where('status', 'Aktif')->get();
        $this->transaksi = $rowId ? Transaksi::find($rowId) : new Transaksi;
        if ($this->transaksi->exists) {
            $this->nasabah_id = $this->transaksi->nasabah_id;
            $this->user_id = $this->transaksi->user_id;
            $this->tgl_transaksi = $this->transaksi->tgl_transaksi;
            $this->total_sampah = $this->transaksi->total_sampah;
            $this->total_berat = $this->transaksi->total_berat;
            $this->total_harga = $this->transaksi->total_harga;
            $this->status = $this->transaksi->status;
        }
    }
}
