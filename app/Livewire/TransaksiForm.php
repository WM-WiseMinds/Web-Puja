<?php

namespace App\Livewire;

use App\Models\Nasabah;
use App\Models\Tabungan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class TransaksiForm extends ModalComponent
{
    use Toastable;

    public Transaksi $transaksi;
    public $id, $user_name, $user_id, $nasabah, $nasabah_id, $tgl_transaksi, $total_sampah, $total_harga, $status;

    public function mount($rowId = null)
    {
        $this->id = $rowId;
        $this->transaksi = $rowId ? Transaksi::find($rowId) : new Transaksi();
        $this->user_id = auth()->user()->id;
        $this->user_name = auth()->user()->name;
        $this->nasabah = Nasabah::where('status', 'Aktif')->get();
        $this->tgl_transaksi = $this->transaksi->tgl_transaksi;
        $this->total_sampah = $this->total_sampah;
        $this->total_harga = $this->total_harga;
        $this->status = $rowId ? $this->transaksi->status : 'Aktif';
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'nasabah_id' => 'required|exists:nasabah,id',
            'tgl_transaksi' => 'required',
            'total_sampah' => 'required',
            'total_harga' => 'required',
            'status' => 'required',
        ];
    }

    public function resetForm()
    {
        $this->reset(['user_id', 'nasabah_id', 'tgl_transaksi', 'total_sampah', 'total_harga', 'status']);
    }

    public function store()
    {
        $validatedData = $this->validate();

        $nasabahId = $this->transaksi->nasabah_id;

        $this->transaksi = Transaksi::updateOrCreate(['id' => $this->id], $validatedData);

        if ($nasabahId !== $this->transaksi->nasabah_id) {
            $tabungan = Tabungan::where('nasabah_id', $nasabahId)->first();

            if ($tabungan) {
                $tabungan->nasabah_id = $this->transaksi->nasabah_id;
                $tabungan->save();
            }
        }

        $this->success($this->transaksi->wasRecentlyCreated ? 'Transaksi berhasil ditambahkan' : 'Transaksi berhasil diubah');

        $this->closeModalWithEvents([
            TransaksiTable::class => 'transaksiUpdated',
        ]);

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.transaksi-form');
    }
}
