<div>
    <h2>Tabel Penukaran</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Id</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Nama Nasabah</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Nama Barang</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Harga Barang</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Tanggal Penukaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasource as $penukaran)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $penukaran->id }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $penukaran->tabungan->nasabah->user->name }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $penukaran->barang->nama_barang }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        Rp {{ number_format($penukaran->harga_barang_saat_tukar, 0, ',', '.') }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $penukaran->created_at->format('d/m/Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
