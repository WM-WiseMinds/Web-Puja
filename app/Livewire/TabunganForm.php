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

    public function mount($rowId = null)
    {
        $this->tabungan = Tabungan::findOrNew($rowId);
        if ($this->tabungan->exists) {
            $this->status = $this->tabungan->status;
        }
    }

    public function rules()
    {
        return [
            'status' => 'required'
        ];
    }

    public function resetForm()
    {
        $this->reset(['status']);
    }

    public function store()
    {
        $this->validate();
        $this->tabungan->status = $this->status;
        $this->tabungan->save();

        $this->success('Data tabungan berhasil diupdate');

        $this->closeModalWithEvents([
            TabunganTable::class => 'tabunganUpdated'
        ]);

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.tabungan-form');
    }
}
