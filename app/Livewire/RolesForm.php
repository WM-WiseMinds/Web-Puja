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

    public $roles, $id, $name, $permissions;
    public $permissions_id = [];

    public function render()
    {
        $permissions = Permissions::all(); // This ensures $permissions is always set
        $roles = Roles::all();
        return view('livewire.roles-form', compact('permissions', 'roles'));
    }

    public function resetCreateForm()
    {
        $this->name = '';
        $this->permissions_id = [];
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
    }

    public function mount($rowId = null)
    {
        $this->permissions = Permissions::all();
        if (!is_null($rowId)) {
            $this->permissions = Permissions::all();
            $roles = Roles::findOrFail($rowId);
            $this->id = $rowId;
            $this->name = $roles->name;
            $this->permissions_id = $roles->permissions->pluck('id')->toArray();
        }
    }
}
