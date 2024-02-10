<?php

namespace App\Livewire;

use App\Models\Sampah;
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

final class SampahTable extends PowerGridComponent
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
        return Sampah::query()
            ->with('transaksi.nasabah.user')
            ->join('transaksi', 'transaksi.id', '=', 'sampah.transaksi_id')
            ->select('sampah.*', 'transaksi.id as transaksi_id', 'transaksi.total_sampah', 'transaksi.total_berat', 'transaksi.created_at')
            ->addSelect(['nasabah_user_name' => function ($query) {
                $query->select('name')
                    ->from('users')
                    ->whereColumn('users.id', 'transaksi.user_id');
            }]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('transaksi_id')
            ->add('jenis_sampah')
            ->add('nama_sampah')
            ->add('harga_sampah')
            ->add('jumlah_sampah')
            ->add('nasabah_user_name')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Jenis sampah', 'jenis_sampah')
                ->sortable()
                ->searchable(),
            Column::make('Nama sampah', 'nama_sampah')
                ->sortable()
                ->searchable(),
            Column::make('Harga sampah', 'harga_sampah')
                ->sortable()
                ->searchable(),
            Column::make('Jumlah sampah', 'jumlah_sampah')
                ->sortable()
                ->searchable(),
            Column::make('Nama Nasabah', 'nasabah_user_name')
                ->sortable()
                ->searchable(),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\Sampah $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                // 'exportPdf',
                // 'bulkExportPdf',
                // 'delete',
                'transaksiUpdated' => '$refresh',
            ]
        );
    }
}
