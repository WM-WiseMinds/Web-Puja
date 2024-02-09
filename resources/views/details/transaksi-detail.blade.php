<div class="p-2 bg-white border border-slate-200">
    <table class="table-auto w-full">
        <tbody>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Id</td>
                <td class="border px-4 py-2">{{ $id }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Nama Nasabah</td>
                <td class="border px-4 py-2">{{ $row->nasabah->user->name }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Alamat</td>
                <td class="border px-4 py-2">{{ $row->nasabah->alamat }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">No HP</td>
                <td class="border px-4 py-2">{{ $row->nasabah->no_hp }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Total Sampah</td>
                <td class="border px-4 py-2">{{ $row->total_sampah }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Total Berat</td>
                <td class="border px-4 py-2">{{ $row->total_berat }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Total Harga</td>
                <td class="border px-4 py-2">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Nama Penanggung Jawab</td>
                <td class="border px-4 py-2">{{ $row->user->name }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Status</td>
                <td class="border px-4 py-2">{{ $row->status }}</td>
            </tr>
            <tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Created At</td>
                <td class="border px-4 py-2">{{ $row->created_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
