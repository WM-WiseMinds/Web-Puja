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
    public $id, $users, $user_id, $alamat, $no_hp, $jenis_kelamin, $status, $foto, $foto_url;

    public function mount($rowId = null)
    {
        $this->nasabah = Nasabah::findOrNew($rowId);
        $this->users = User::whereHas('role', function ($query) {
            $query->where('name', 'Nasabah');
        })->where('status', 'Aktif')->get();
        $this->id = $this->nasabah->id;
        $this->user_id = $this->nasabah->user_id;
        $this->alamat = $this->nasabah->alamat;
        $this->no_hp = $this->nasabah->no_hp;
        $this->jenis_kelamin = $this->nasabah->jenis_kelamin;
        $this->status = $rowId ? $this->nasabah->status : 'Aktif';
        $this->foto = $this->nasabah->foto;

        if ($this->nasabah->foto) {
            $this->foto_url = Storage::disk('public')->url('nasabah-foto/' . $this->nasabah->foto);
        }
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'alamat' => 'required|min:3',
            'no_hp' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'foto' => $this->foto instanceof UploadedFile ? ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'] : ['nullable'],
        ];
    }

    public function resetForm()
    {
        $this->reset(['user_id', 'alamat', 'no_hp', 'jenis_kelamin', 'status', 'foto']);
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->foto instanceof UploadedFile) {
            $originalName = pathinfo($this->foto->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $this->foto->getClientOriginalExtension();
            $fileName = time() . '_' . $originalName . '.' . $extension;

            if ($this->nasabah->foto) {
                Storage::disk('public')->delete('nasabah-foto/' . $this->nasabah->foto);
            }

            $this->foto->storeAs('public/nasabah-foto', $fileName);
            $validatedData['foto'] = $fileName;
        } else {
            $validatedData['foto'] = $this->nasabah->foto;
        }

        $this->nasabah = Nasabah::updateOrCreate(['id' => $this->id], $validatedData);

        $this->success($this->nasabah->wasRecentlyCreated ? 'Nasabah berhasil ditambahkan' : 'Nasabah berhasil diupdate');

        $this->closeModalWithEvents([
            NasabahTable::class => 'nasabahUpdated',
        ]);

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.nasabah-form');
    }
}
