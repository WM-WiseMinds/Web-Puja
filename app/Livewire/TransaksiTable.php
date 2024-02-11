<?php

namespace App\Livewire;

use App\Models\Sampah;
use App\Models\Tabungan;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Masmerise\Toaster\Toastable;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class TransaksiTable extends PowerGridComponent
{
    use WithExport;
    use Toastable;

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
            Detail::make()
                ->view('details.transaksi-detail')
                ->showCollapseIcon(),
        ];
    }

    public function datasource(): Builder
    {
        return Transaksi::query()
            ->with('sampah')
            ->join('users', 'transaksi.user_id', '=', 'users.id')
            ->join('nasabah', 'transaksi.nasabah_id', '=', 'nasabah.id')
            ->join('users as nasabah_user', 'nasabah.user_id', '=', 'nasabah_user.id')
            ->select([
                'transaksi.id',
                'transaksi.user_id',
                'transaksi.nasabah_id',
                'transaksi.total_sampah',
                'transaksi.total_berat',
                'transaksi.total_harga',
                'transaksi.status',
                'transaksi.created_at',
                'users.name as user_name',
                'nasabah.user_id as nasabah_user_id',
                'nasabah_user.name as name',
                'nasabah.alamat as alamat',
                'nasabah.no_hp as no_hp',
            ]);
    }

    public function relationSearch(): array
    {
        return [
            'nasabah' => [
                'alamat', 'no_hp',
            ],
            'nasabah.user' => ['name'],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nasabah_user_id')
            ->add('name')
            ->add('total_harga_formatted', fn (Transaksi $model) => 'Rp ' . number_format($model->total_harga_sampah, 0, ',', '.'))
            ->add('status')
            ->add('created_at_formatted', fn (Transaksi $model) => Carbon::parse($model->created_at)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->sortable(),
            Column::make('Nama Nasabah', 'name'),

            Column::make('Total harga', 'total_harga_formatted', 'total_harga')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Tgl transaksi', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('name', 'nasabah.user_id')
                ->dataSource(Transaksi::with('nasabah.user')->get()->map(function ($transaksi) {
                    return ['id' => $transaksi->nasabah->user_id, 'name' => $transaksi->nasabah->user->name];
                })->unique('id'))
                ->optionValue('id')
                ->optionLabel('name'),
            Filter::select('status', 'transaksi.status')
                ->dataSource(Transaksi::all()->unique('status'))
                ->optionValue('status')
                ->optionLabel('status'),
        ];
    }

    public function actions(\App\Models\Transaksi $row): array
    {
        return [
            Button::add('add-sampah')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#10b981" class="w-5 h-5">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                </svg>
                ')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->openModal('sampah-form', ['transaksi_id' => $row->id]),
            Button::add('edit')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#10b981" class="w-5 h-5">
                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                </svg>
                ')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->openModal('transaksi-form', ['rowId' => $row->id]),
            Button::add('delete')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#10b981" class="w-5 h-5">
                <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.133 2.845a.75.75 0 0 1 1.06 0l1.72 1.72 1.72-1.72a.75.75 0 1 1 1.06 1.06l-1.72 1.72 1.72 1.72a.75.75 0 1 1-1.06 1.06L12 15.685l-1.72 1.72a.75.75 0 1 1-1.06-1.06l1.72-1.72-1.72-1.72a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
                ')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
    }

    public function header(): array
    {
        return [
            Button::add('add-transaksi')
                ->slot(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#10b981" class="w-5 h-5">
                <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875ZM12.75 12a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V18a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V12Z" clip-rule="evenodd" />
                <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                </svg>
                '))
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700 w-full')
                ->openModal('transaksi-form', []),
            Button::add('export-pdf')
                ->slot(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#10b981" class="w-5 h-5">
                <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 0 0 3 3h.27l-.155 1.705A1.875 1.875 0 0 0 7.232 22.5h9.536a1.875 1.875 0 0 0 1.867-2.045l-.155-1.705h.27a3 3 0 0 0 3-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0 0 18 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM16.5 6.205v-2.83A.375.375 0 0 0 16.125 3h-8.25a.375.375 0 0 0-.375.375v2.83a49.353 49.353 0 0 1 9 0Zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 0 1-.374.409H7.232a.375.375 0 0 1-.374-.409l.526-5.784a.373.373 0 0 1 .333-.337 41.741 41.741 0 0 1 8.566 0Zm.967-3.97a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H18a.75.75 0 0 1-.75-.75V10.5ZM15 9.75a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V10.5a.75.75 0 0 0-.75-.75H15Z" clip-rule="evenodd" />
                </svg>'))
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700 w-full')
                ->dispatch('exportPdf', []),
            Button::add('bulk-export-pdf')
                ->slot(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#10b981" class="w-5 h-5">
                <path fill-rule="evenodd" d="M9.75 6.75h-3a3 3 0 0 0-3 3v7.5a3 3 0 0 0 3 3h7.5a3 3 0 0 0 3-3v-7.5a3 3 0 0 0-3-3h-3V1.5a.75.75 0 0 0-1.5 0v5.25Zm0 0h1.5v5.69l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l1.72 1.72V6.75Z" clip-rule="evenodd" />
                <path d="M7.151 21.75a2.999 2.999 0 0 0 2.599 1.5h7.5a3 3 0 0 0 3-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 0 1-4.5 4.5H7.151Z" />
                </svg>(<span class="text-emerald-500 fill-emerald-500" x-text="window.pgBulkActions.count(\'' . $this->tableName . '\')"></span>)'))
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700 w-full')
                ->dispatch('bulkExportPdf', []),

        ];
    }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'exportPdf',
                'bulkExportPdf',
                'delete',
                'transaksiUpdated' => '$refresh',
                'sampahUpdated' => '$refresh',
                'sampahDeleted' => '$refresh',
            ]
        );
    }

    // Function to export PDF using DomPDF
    public function exportPdf()
    {
        $path = public_path() . '/pdf';
        // Mendapatkan datasource
        $datasource = $this->datasource()->get();
        // Membuat folder pdf jika belum ada
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        // Membuat file pdf
        $pdf = Pdf::loadView('pdf.transaksi', ['datasource' => $datasource]);
        // Menyimpan file pdf ke folder pdf
        $pdf->save($path . '/transaksi.pdf');
        // Menampilkan file pdf
        return response()->download($path . '/transaksi.pdf');
    }

    public function bulkExportPdf()
    {
        // Get the selected rows
        $selectedRows = $this->datasource()->whereIn('transaksi.id', $this->checkboxValues)->get();

        $path = public_path() . '/pdf';
        // Membuat folder pdf jika belum ada
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        // Membuat file pdf
        $pdf = Pdf::loadView('pdf.transaksi', ['datasource' => $selectedRows]);
        // Menyimpan file pdf ke folder pdf
        $pdf->save($path . '/transaksi.pdf');
        // Menampilkan file pdf
        return response()->download($path . '/transaksi.pdf');
    }

    // Function to delete data
    public function delete($rowId)
    {
        $transaksi = Transaksi::findOrFail($rowId);
        $transaksi->delete();
        $this->success('Transaksi berhasil dihapus');
    }

    public function deleteSampah($sampah_id)
    {
        $sampah = Sampah::find($sampah_id);
        if ($sampah) {
            // Hitung total harga sampah
            $totalHargaSampah = $sampah->jumlah_sampah * $sampah->harga_sampah;

            // Dapatkan tabungan nasabah
            $tabungan = Tabungan::where('nasabah_id', $sampah->transaksi->nasabah_id)->first();

            if ($tabungan) {
                // Kurangi total harga sampah dari saldo tabungan
                $tabungan->updateSaldo($totalHargaSampah, 'kredit', 'Penghapusan Data Sampah');
            }

            $sampah->delete();
            $this->success('Sampah berhasil dihapus');
            $this->success('Tabungan berhasil diupdate');
        }
    }
}
