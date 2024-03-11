<?php

namespace App\Livewire;

use App\Models\Permissions;
use App\Models\Roles;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class RolesForm extends ModalComponent
{
    use Toastable;

    public Roles $roles;
    public $id, $name, $permissions;
    public $permissions_id = [];

    public function mount($rowId = null)
    {
        $this->roles = Roles::findOrNew($rowId);
        $this->permissions = Permissions::all();
        $this->id = $this->roles->id;
        $this->name = $this->roles->name;
        $this->permissions_id = $this->roles->permissions->pluck('id')->toArray();
    }

    public function resetCreateForm()
    {
        $this->reset(['id', 'name', 'permissions_id']);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'permissions_id' => 'required|array',
        ]);

        if ($this->id) {
            $role = Roles::find($this->id);
            $role->update([
                'name' => $this->name,
            ]);
            $role->permissions()->sync($this->permissions_id);

            $this->success('Roles berhasil diupdate');
        } else {
            $role = Roles::create([
                'name' => $this->name,
            ]);
            $role->permissions()->attach($this->permissions_id);

            $this->success('Roles berhasil ditambahkan');
        }

        $this->closeModalWithEvents([
            RolesTable::class => 'rolesUpdated',
        ]);

        $this->resetCreateForm();

        $this->dispatch('sidebar-updated');
    }

    public function render()
    {
        return view('livewire.roles-form');
    }
}
