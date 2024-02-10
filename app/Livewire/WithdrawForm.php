<?php

namespace App\Livewire;

use App\Models\HistoryTabungan;
use App\Models\Tabungan;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toastable;

class WithdrawForm extends ModalComponent
{
    use Toastable;

    public Tabungan $tabungan;
    public $withdraw;

    public function render()
    {
        return view('livewire.withdraw-form');
    }

    public function resetCreateForm()
    {
        $this->reset(['withdraw']);
    }

    public function store()
    {
        if ($this->tabungan->saldo === null || !is_numeric($this->tabungan->saldo)) {
            $this->tabungan->saldo = 0;
        }

        $validatedData = $this->validate([
            'withdraw' => 'required|numeric|min:1|max:' . $this->tabungan->saldo,
        ]);

        // Perform the withdrawal
        $this->tabungan->saldo -= $validatedData['withdraw'];
        $this->tabungan->save();

        // Create a new HistoryTabungan instance
        $history = new HistoryTabungan;
        $history->tabungan_id = $this->tabungan->id;
        $history->debit = 0;
        $history->kredit = $validatedData['withdraw'];
        $history->keterangan = 'Withdraw tabungan';
        $history->save();

        $this->success('Withdraw tabungan berhasil dilakukan');

        $this->closeModalWithEvents([
            TabunganTable::class => 'withDrawUpdated'
        ]);

        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        $this->tabungan = $rowId ? Tabungan::find($rowId) : new Tabungan;
        $this->withdraw = 0;
    }
}
