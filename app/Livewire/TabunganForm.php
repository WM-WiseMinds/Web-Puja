<?php

namespace App\Livewire;

use App\Models\Tabungan;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class TabunganForm extends ModalComponent
{
    use Toastable;

    public Tabungan $tabungan;
    public $status;

    public function render()
    {
        return view('livewire.tabungan-form');
    }

    public function resetCreateForm()
    {
        $this->reset(['status']);
    }

    public function store()
    {
        $validatedData = $this->validate([
            'status' => 'required',
        ]);

        $this->tabungan->fill($validatedData);
        $this->tabungan->save();

        $this->success('Status tabungan berhasil diubah');

        $this->closeModalWithEvents([
            TabunganTable::class => 'tabunganUpdated'
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        $this->tabungan = $rowId ? Tabungan::find($rowId) : new Tabungan;
        if ($this->tabungan->exists) {
            $this->status = $this->tabungan->status;
        }
    }
}
