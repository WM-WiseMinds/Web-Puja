<?php

namespace App\Livewire;

use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class NasabahForm extends ModalComponent
{
    use Toastable;
    use WithFileUploads;

    public Nasabah $nasabah;
    public $user, $user_id, $alamat, $no_hp, $jenis_kelamin, $status, $foto;

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'alamat' => 'required|min:3',
        'no_hp' => 'required|min:3',
        'jenis_kelamin' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'required',
    ];

    public function render()
    {
        $nasabah = Nasabah::all();
        $users = User::all();
        return view('livewire.nasabah-form', compact('nasabah', 'users'));
    }

    public function resetCreateForm()
    {
        $this->reset(['user_id', 'alamat', 'no_hp', 'jenis_kelamin', 'status', 'foto']);
    }

    public function store()
    {
        if ($this->foto instanceof UploadedFile && $this->foto->isValid()) {
            $validatedData = $this->validate();

            // Delete the old photo if it exists
            if ($this->nasabah->foto) {
                Storage::disk('public')->delete($this->nasabah->foto);
            }

            // Store the new photo
            $validatedData['foto'] = $validatedData['foto']->store('nasabah-foto', 'public');
        } else {
            $validatedData = $this->validate([
                'user_id' => 'required|exists:users,id',
                'alamat' => 'required|min:3',
                'no_hp' => 'required|min:3',
                'jenis_kelamin' => 'required',
                'status' => 'required',
            ]);

            // Keep the old photo
            $validatedData['foto'] = $this->nasabah->foto;
        }

        $this->nasabah->fill($validatedData);
        $this->nasabah->save();

        $this->success($this->nasabah->wasRecentlyCreated ? 'Nasabah berhasil ditambahkan' : 'Nasabah berhasil diupdate');

        $this->closeModalWithEvents([
            NasabahTable::class => 'nasabahUpdated',
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        $this->user = User::all();
        $this->nasabah = $rowId ? Nasabah::findOrFail($rowId) : new Nasabah;
        if ($this->nasabah->exists) {
            $this->user_id = $this->nasabah->user_id;
            $this->alamat = $this->nasabah->alamat;
            $this->no_hp = $this->nasabah->no_hp;
            $this->jenis_kelamin = $this->nasabah->jenis_kelamin;
            $this->foto = $this->nasabah->foto;
            $this->status = $this->nasabah->status;
        }
    }
}
