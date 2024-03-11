<?php

namespace App\Livewire;

use App\Models\Barang;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class BarangForm extends ModalComponent
{
    use Toastable;
    use WithFileUploads;

    public Barang $barang;
    public $id, $nama_barang, $harga_barang, $stok_barang, $gambar_barang, $keterangan, $status, $gambar_url;

    public function mount($rowId = null)
    {
        $this->barang = Barang::findOrNew($rowId);
        $this->id = $this->barang->id;
        $this->nama_barang = $this->barang->nama_barang;
        $this->harga_barang = $this->barang->harga_barang;
        $this->stok_barang = $this->barang->stok_barang;
        $this->keterangan = $this->barang->keterangan;
        $this->status = $rowId ? $this->barang->status : 'Aktif';
        $this->gambar_barang = $this->barang->gambar_barang;

        if ($this->gambar_barang) {
            $this->gambar_url = Storage::disk('public')->url('gambar-barang/' . $this->gambar_barang);
        }
    }

    public function rules()
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric|min:0',
            'stok_barang' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'status' => 'required',
            'gambar_barang' => $this->gambar_barang instanceof UploadedFile ? ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'] : ['nullable'],
        ];
    }

    public function resetForm()
    {
        $this->reset(['nama_barang', 'harga_barang', 'stok_barang', 'keterangan', 'status', 'gambar_barang']);
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->gambar_barang instanceof UploadedFile) {
            $originalName = pathinfo($this->gambar_barang->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $this->gambar_barang->extension();
            $fileName = time() . '_' . $originalName . '.' . $extension;

            if ($this->barang->gambar_barang) {
                Storage::disk('public')->delete('gambar-barang/', $this->barang->gambar_barang);
            }

            $this->gambar_barang->storeAs('public/gambar-barang', $fileName);
            $validatedData['gambar_barang'] = $fileName;
        } else {
            $validatedData['gambar_barang'] = $this->barang->gambar_barang;
        }

        $this->barang = Barang::updateOrCreate(['id' => $this->id], $validatedData);

        $this->closeModalWithEvents([
            BarangTable::class => 'barangUpdated'
        ]);

        $this->success($this->barang->wasRecentlyCreated ? 'Data Barang Berhasil Dibuat' : 'Data Barang Berhasil Diubah');

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.barang-form');
    }
}
