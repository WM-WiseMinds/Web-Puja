<?php

namespace App\Livewire;

use App\Models\Permissions;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class PermissionsForm extends ModalComponent
{
    use Toastable;
    public $permissions, $id, $name;

    public function render()
    {
        $permissions = Permissions::all();
        return view('livewire.permissions-form', compact('permissions'));
    }

    public function resetCreateForm()
    {
        $this->name = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
        ]);

        if ($this->id) {
            $permissions = Permissions::find($this->id);
            $permissions->update([
                'name' => $this->name,
            ]);
            $this->success('Permissions berhasil diupdate');
        } else {
            Permissions::create([
                'name' => $this->name,
            ]);
            $this->success('Permissions berhasil ditambahkan');
        }


        $this->closeModalWithEvents([
            PermissionsTable::class => 'permissionsUpdated',
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        if (!is_null($rowId)) {
            $permissions = Permissions::findOrFail($rowId);
            $this->id = $rowId;
            $this->name = $permissions->name;
        }
    }
}
