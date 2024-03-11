<div class="p-2 bg-white border border-slate-200">
    <table class="table-auto w-full">
        <tbody>
            @if ($row->foto)
                <tr>
                    <td class="border px-4 py-2 text-sm font-semibold">Foto</td>
                    <td class="border px-4 py-2">
                        <img src="{{ asset('storage/' . $row->foto) }}" alt="Foto" class="w-32 h-32 object-cover mb-5">
                        <x-button>
                            <a href="{{ asset('storage/' . $row->foto) }}" download>
                                Download
                            </a>
                        </x-button>
                    </td>

                </tr>
            @endif
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Nama Nasabah</td>
                <td class="border px-4 py-2">{{ $row->name }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Alamat</td>
                <td class="border px-4 py-2">{{ $row->alamat }}</td>
            </tr>
            <tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Jenis Kelamin</td>
                <td class="border px-4 py-2">{{ $row->jenis_kelamin }}</td>
            </tr>
            <tr>
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
