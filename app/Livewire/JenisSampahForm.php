<?php

namespace App\Livewire;

use App\Models\JenisSampah;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class JenisSampahForm extends ModalComponent
{
    use Toastable;

    public JenisSampah $jenisSampah;
    public $id, $nama_jenis, $harga, $status;

    public function mount($rowId = null)
    {
        $this->jenisSampah = JenisSampah::findOrNew($rowId);
        $this->id = $this->jenisSampah->id;
        $this->nama_jenis = $this->jenisSampah->nama_jenis_sampah;
        $this->harga = $this->jenisSampah->harga;
        $this->status = $rowId ? $this->jenisSampah->status : 'Aktif';
    }

    public function rules()
    {
        return [
            'nama_jenis' => 'required|min:3|max:50|unique:jenis_sampah,nama_jenis,' . $this->id,
            'harga' => 'required|numeric|min:1000',
            'status' => 'required',
        ];
    }

    public function resetForm()
    {
        $this->reset(['nama_jenis_sampah', 'harga', 'status']);
    }

    public function store()
    {
        $validatedData = $this->validate();

        $this->jenisSampah = JenisSampah::updateOrCreate(['id' => $this->id], $validatedData);

        $this->success($this->jenisSampah->wasRecentlyCreated ? 'Jenis sampah berhasil disimpan' : 'Jenis sampah berhasil diubah');

        $this->closeModalWithEvents([
            JenisSampahTable::class => 'jenisSampahUpdated',
        ]);

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.jenis-sampah-form');
    }
}
