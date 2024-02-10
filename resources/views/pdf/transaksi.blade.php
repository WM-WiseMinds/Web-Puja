<div>
    <h2>Tabel Transaksi</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Id</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Nama Nasabah</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Total Sampah</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Total Berat</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Total Harga</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasource as $transaksi)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $transaksi->id }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $transaksi->nasabah->user->name }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $transaksi->total_sampah }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $transaksi->total_berat }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $transaksi->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
