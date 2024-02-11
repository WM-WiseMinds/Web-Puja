<div class="p-2 bg-white border border-slate-200">
    @php
        $saldo = intval($row->saldo);
        foreach ($row->historyTabungan as $historyTabungan) {
            $debit = intval($historyTabungan->debit);
            $kredit = intval($historyTabungan->kredit);
            $saldo = $saldo + $debit - $kredit;
        }
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
                <td class="border px-4 py-2 text-sm font-semibold">Saldo</td>
                <td class="border px-4 py-2">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
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
                <th class="border px-4 py-2 text-sm font-semibold">Debit</th>
                <th class="border px-4 py-2 text-sm font-semibold">Kredit</th>
                <th class="border px-4 py-2 text-sm font-semibold">Saldo</th>
                <th class="border px-4 py-2 text-sm font-semibold">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php
                $saldo = intval($row->saldo);
            @endphp --}}
            @foreach ($row->historyTabungan as $historyTabungan)
                {{-- @php
                    $debit = intval($historyTabungan->debit);
                    $kredit = intval($historyTabungan->kredit);
                    $saldo = $saldo + $debit - $kredit;
                @endphp --}}
                <tr>
                    <td class="border px-4 py-2">Rp {{ number_format($historyTabungan->debit, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($historyTabungan->kredit, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">{{ $historyTabungan->keterangan }}</td>
                </tr>
            @endforeach
            {{-- @php
                // Update the saldo field in the Tabungan model
                $row->update(['saldo' => $saldo]);
            @endphp --}}
        </tbody>
    </table>
</div>
