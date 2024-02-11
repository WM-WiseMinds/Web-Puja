<div>
    <h2>Tabel Tabungan</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Id</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Nama Nasabah</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Saldo</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasource as $tabungan)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $tabungan->id }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $tabungan->nasabah->user->name }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        Rp {{ number_format($tabungan->saldo, 0, ',', '.') }}
                    </td>
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $tabungan->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
