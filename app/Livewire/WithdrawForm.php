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

    public $tabungan_id;
    public $withdraw;

    public function mount($rowId = null)
    {
        $this->tabungan_id = $rowId;
    }

    public function rules()
    {
        return [
            'withdraw' => 'required|numeric|min:0'
        ];
    }

    public function resetForm()
    {
        $this->reset(['withdraw']);
    }

    public function store()
    {
        $this->validate();

        $tabungan = Tabungan::find($this->tabungan_id);

        if ($tabungan) {
            if ($this->withdraw > $tabungan->saldo) {
                $this->error('Saldo tidak mencukupi untuk melakukan penarikan.');
                return;
            }

            $keteranganWithdraw = 'Penarikan Tabungan - ' . now()->format('d/m/Y');
            $tabungan->updateSaldo($this->withdraw, 'kredit', 'increment', $keteranganWithdraw);
            $this->success('Penarikan berhasil dilakukan');
        } else {
            $this->error('Tabungan tidak ditemukan');
        }

        $this->closeModalWithEvents([
            TabunganTable::class => 'tabunganUpdated'
        ]);

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.withdraw-form');
    }
}
