<?php

namespace App\Livewire;

use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class BarangForm extends ModalComponent
{
    use Toastable;
    use WithFileUploads;

    public Barang $barang;
    public $nama_barang, $harga_barang, $stok_barang, $gambar_barang, $keterangan, $status, $gambar_url;

    protected $rules = [
        'nama_barang' => 'required',
        'harga_barang' => 'required|numeric|min:0',
        'stok_barang' => 'required|numeric|min:0',
        'gambar_barang' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,gif',
        'keterangan' => 'required',
        'status' => 'required',
    ];

    public function render()
    {
        return view('livewire.barang-form');
    }

    public function resetCreateForm()
    {
        $this->reset(['nama_barang', 'harga_barang', 'stok_barang', 'gambar_barang', 'keterangan', 'status']);
    }

    public function store()
    {
        $validatedData = $this->validate();
        if ($this->gambar_barang) {
            if ($this->barang->exists && $this->barang->gambar_barang) {
                Storage::disk('public')->delete($this->barang->gambar_barang);
            }
            $validatedData['gambar_barang'] = $this->gambar_barang->store('gambar-barang', 'public');
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $validatedData['gambar_barang'] = $this->barang->gambar_barang;
        }

        $this->barang->fill($validatedData);
        $this->barang->save();

        $this->success($this->barang->wasRecentlyCreated ? 'Barang berhasil ditambahkan' : 'Barang berhasil diubah');
        $this->closeModalWithEvents([
            BarangTable::class => 'barangUpdated',
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        $this->barang = $rowId ? Barang::find($rowId) : new Barang();
        if ($this->barang->exists) {
            $this->nama_barang = $this->barang->nama_barang;
            $this->harga_barang = $this->barang->harga_barang;
            $this->stok_barang = $this->barang->stok_barang;
            $this->keterangan = $this->barang->keterangan;
            $this->status = $this->barang->status;

            // Menambahkan URL gambar
            if ($this->barang->gambar_barang) {
                $this->gambar_url = Storage::disk('public')->url($this->barang->gambar_barang);
            }
        }
    }
}
