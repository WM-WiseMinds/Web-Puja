<?php

namespace App\Livewire;

use App\Models\Sampah;
use App\Models\Transaksi;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class SampahForm extends ModalComponent
{
    use Toastable;

    public Sampah $sampah;
    public $transaksi, $jenis_sampah, $nama_sampah, $harga_sampah, $jumlah_sampah, $transaksi_id;
    public $sampahItems = [];

    public function render()
    {
        $transaksi = Transaksi::all();
        return view('livewire.sampah-form', compact('transaksi'));
    }

    protected $rules = [
        'transaksi_id' => 'required|exists:transaksi,id',
        'jenis_sampah' => 'required',
        'nama_sampah' => 'required',
        'harga_sampah' => 'required|numeric|min:0',
        'jumlah_sampah' => 'required|numeric|min:0',
    ];

    public function addSampahItem()
    {
        $this->sampahItems[] = ['jenis_sampah' => '', 'nama_sampah' => '', 'harga_sampah' => '', 'jumlah_sampah' => ''];
    }

    public function removeSampahItem($index)
    {
        unset($this->sampahItems[$index]);
        $this->sampahItems = array_values($this->sampahItems);
    }

    public function resetCreateForm()
    {
        $this->reset(['transaksi_id', 'jenis_sampah', 'nama_sampah', 'harga_sampah', 'jumlah_sampah']);
    }

    public function store()
    {
        foreach ($this->sampahItems as $item) {
            $validatedData = $this->validate([
                'transaksi_id' => 'required|exists:transaksi,id',
                'sampahItems.*.jenis_sampah' => 'required',
                'sampahItems.*.nama_sampah' => 'required',
                'sampahItems.*.harga_sampah' => 'required|numeric|min:0',
                'sampahItems.*.jumlah_sampah' => 'required|numeric|min:0',
            ]);

            if ($this->sampah->exists) {
                // Updating an existing Sampah
                $this->sampah->update($item);
                $this->success('Sampah berhasil diubah');
            } else {
                // Creating a new Sampah
                $sampah = new Sampah();
                $sampah->fill($item);
                $sampah->transaksi_id = $this->transaksi_id;
                $sampah->save();
                $this->success('Sampah berhasil ditambahkan');
            }
        }

        $this->closeModalWithEvents([
            TransaksiTable::class => 'sampahUpdated',
        ]);

        $this->resetCreateForm();
    }

    // public function mount($transaksi_id = null, $sampah_id = null)
    // {
    //     $this->transaksi_id = $transaksi_id;
    //     $this->transaksi = Transaksi::all();
    //     $this->sampah = $sampah_id ? Sampah::find($sampah_id) : new Sampah;
    //     if ($this->sampah && $this->sampah->exists) {
    //         $this->transaksi_id = $this->sampah->transaksi_id;
    //         $this->jenis_sampah = $this->sampah->jenis_sampah;
    //         $this->nama_sampah = $this->sampah->nama_sampah;
    //         $this->harga_sampah = $this->sampah->harga_sampah;
    //         $this->jumlah_sampah = $this->sampah->jumlah_sampah;
    //     }
    // }

    public function mount($transaksi_id = null, $sampah_id = null)
    {
        $this->transaksi_id = $transaksi_id;
        $this->transaksi = Transaksi::all();

        if ($sampah_id) {
            // Editing an existing Sampah
            $this->sampah = Sampah::find($sampah_id);
            $this->sampahItems = [
                [
                    'jenis_sampah' => $this->sampah->jenis_sampah,
                    'nama_sampah' => $this->sampah->nama_sampah,
                    'harga_sampah' => $this->sampah->harga_sampah,
                    'jumlah_sampah' => $this->sampah->jumlah_sampah,

                ]
            ];
            $this->transaksi_id = $this->sampah->transaksi_id;
        } else {
            // Adding a new Sampah
            $this->sampah = new Sampah;
            $this->sampahItems = [];
        }
    }
}
