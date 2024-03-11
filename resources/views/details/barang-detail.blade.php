<div class="p-2 bg-white border border-slate-200">
    <table class="table-auto w-full">
        <tbody>
            @if ($row->gambar_barang)
                <tr>
                    <td class="border px-4 py-2 text-sm font-semibold">Gambar Barang</td>
                    <td class="border px-4 py-2">
                        <img src="{{ asset('storage/' . $row->gambar_barang) }}" alt="Gambar_barang"
                            class="w-32 h-32 object-cover mb-5">
                        <x-button>
                            <a href="{{ asset('storage/' . $row->gambar_barang) }}" download>
                                Download
                            </a>
                        </x-button>
                    </td>

                </tr>
            @endif
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Nama Barang</td>
                <td class="border px-4 py-2">{{ $row->nama_barang }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Harga Barang</td>
                <td class="border px-4 py-2">{{ $row->harga_barang }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Stok Barang</td>
                <td class="border px-4 py-2">{{ $row->stok_barang }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Keterangan</td>
                <td class="border px-4 py-2">{{ $row->keterangan }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Status</td>
                <td class="border px-4 py-2">{{ $row->status }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Created At</td>
                <td class="border px-4 py-2">{{ $row->created_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
