<?php

namespace App\Livewire;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class UserForm extends ModalComponent
{
    use Toastable;
    public User $user;
    public $id, $name, $email, $password, $password_confirmation, $roles, $role_id, $status;

    public function mount($rowId = null)
    {
        $this->user = User::findOrNew($rowId);
        $this->roles = Roles::all();
        $this->id = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role_id = $this->user->role_id;
        $this->status = $rowId ? $this->user->status : 'Aktif';
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->id)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
            'status' => ['required'],
        ];
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role_id', 'status']);
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['password'] = Hash::make($validatedData['password']);

        $this->user = User::updateOrCreate(['id' => $this->id], $validatedData);

        $this->closeModalWithEvents([
            UserTable::class => 'userUpdated'
        ]);

        $this->success($this->user->wasRecentlyCreated ? 'Data User Berhasil Dibuat' : 'Data User Berhasil Diubah');

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
