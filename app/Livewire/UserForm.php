<?php

namespace App\Livewire;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class UserForm extends ModalComponent
{
    use Toastable;
    public $user, $name, $email, $password, $password_confirmation, $user_id, $roles, $role_id, $no_hp, $status;

    public function render()
    {
        $users = User::all();
        $roles = Roles::all();
        return view('livewire.user-form', compact('users', 'roles'));
    }

    public function resetCreateForm()
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role_id', 'status']);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min:3',
            'role_id' => 'required',
            'password' => 'required|min:6|confirmed',
            'status' => 'required',
        ];

        if ($this->user_id) {
            // If updating an existing user, ignore the current user's email
            $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($this->user_id)];
        } else {
            // If creating a new user, the email must be unique
            $rules['email'] = 'required|email|unique:users,email';
        }

        $this->validate($rules);

        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'role_id' => $this->role_id,
                'status' => $this->status,
            ]);

            $this->success('User berhasil diupdate');
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'role_id' => $this->role_id,
                'status' => $this->status,
            ]);

            $this->success('User berhasil ditambahkan');
        }

        $this->closeModalWithEvents([
            UserTable::class => 'userUpdated',
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        $this->roles = Roles::all();
        if (!is_null($rowId)) {
            $this->user = User::find($rowId);
            $this->user_id = $this->user->id;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->role_id = $this->user->role_id;
            $this->status = $this->user->status;
        }
    }
}
