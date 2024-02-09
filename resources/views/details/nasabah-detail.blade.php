<div class="p-2 bg-white border border-slate-200">
    <table class="table-auto w-full">
        <tbody>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Id</td>
                <td class="border px-4 py-2">{{ $id }}</td>
            </tr>
            @if ($row->bukti_kehadiran)
                <tr>
                    <td class="border px-4 py-2 text-sm font-semibold">Bukti Kehadiran</td>
                    <td class="border px-4 py-2">
                        <img src="{{ asset('storage/' . $row->bukti_kehadiran) }}" alt="Foto"
                            class="w-32 h-32 object-cover mb-5">
                        <x-button>
                            <a href="{{ asset('storage/' . $row->bukti_kehadiran) }}" download>
                                Download
                            </a>
                        </x-button>
                    </td>

                </tr>
            @endif
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Judul</td>
                <td class="border px-4 py-2">{{ $row->judul_rapat }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Agenda</td>
                <td class="border px-4 py-2">{{ $row->user_name }}</td>
            </tr>
            <tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Waktu Kehadiran</td>
                <td class="border px-4 py-2">{{ $row->created_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
