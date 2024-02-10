<div class="p-2 bg-white border border-slate-200">
    @php
        $totalJumlahSampah = $row->sampah->sum('jumlah_sampah');
        $totalHargaSampah = $row->sampah->sum(function ($sampah) {
            return $sampah->jumlah_sampah * $sampah->harga_sampah;
        });
    @endphp
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
                <td class="border px-4 py-2">{{ $totalJumlahSampah }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Total Berat</td>
                <td class="border px-4 py-2">{{ $row->total_berat }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Total Harga</td>
                <td class="border px-4 py-2">Rp {{ number_format($totalHargaSampah, 0, ',', '.') }}</td>
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

    <table class="table-auto w-full mt-5">
        <thead>
            <tr>
                <th class="border px-4 py-2 text-sm font-semibold">Nama Sampah</th>
                <th class="border px-4 py-2 text-sm font-semibold">Jenis Sampah</th>
                <th class="border px-4 py-2 text-sm font-semibold">Jumlah Sampah</th>
                <th class="border px-4 py-2 text-sm font-semibold">Harga Sampah</th>
                <th class="border px-4 py-2 text-sm font-semibold">Action</th> <!-- Add this line -->
            </tr>
        </thead>
        <tbody>
            @foreach ($row->sampah as $sampah)
                <tr>
                    <td class="border px-4 py-2">{{ $sampah->nama_sampah }}</td>
                    <td class="border px-4 py-2">{{ $sampah->jenis_sampah }}</td>
                    <td class="border px-4 py-2">{{ $sampah->jumlah_sampah }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($sampah->harga_sampah, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2"> <!-- Add this cell -->
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5"
                                onclick="Livewire.dispatch('openModal', { component: 'sampah-form', arguments: { sampah_id: {{ $sampah->id }} } })">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                            </svg>
                        </button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5" wire:click="deleteSampah({{ $sampah->id }})">
                                <path
                                    d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                                <path fill-rule="evenodd"
                                    d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.133 2.845a.75.75 0 0 1 1.06 0l1.72 1.72 1.72-1.72a.75.75 0 1 1 1.06 1.06l-1.72 1.72 1.72 1.72a.75.75 0 1 1-1.06 1.06L12 15.685l-1.72 1.72a.75.75 0 1 1-1.06-1.06l1.72-1.72-1.72-1.72a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
