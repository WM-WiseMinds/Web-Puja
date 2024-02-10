<?php

namespace App\Livewire;

use App\Models\Tabungan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class TabunganTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Tabungan::query()
            ->join('nasabah', 'nasabah.id', '=', 'tabungan.nasabah_id')
            ->join('users', 'users.id', '=', 'nasabah.user_id')
            ->select('tabungan.*', 'users.name as nama');
    }

    public function relationSearch(): array
    {
        return [
            'user' => ['nama'],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nasabah_id')
            // ->add('tanggal_formatted', fn (Tabungan $model) => Carbon::parse($model->tanggal)->format('d/m/Y'))
            // ->add('debit')
            // ->add('kredit')
            ->add('saldo')
            // ->add('keterangan')
            ->add('status')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nasabah id', 'nasabah_id'),
            // Column::make('Tanggal', 'tanggal_formatted', 'tanggal')
            //     ->sortable(),

            // Column::make('Debit', 'debit')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Kredit', 'kredit')
            //     ->sortable()
            //     ->searchable(),

            Column::make('Saldo', 'saldo')
                ->sortable()
                ->searchable(),

            // Column::make('Keterangan', 'keterangan')
            //     ->sortable()
            //     ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('tanggal'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\Tabungan $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}