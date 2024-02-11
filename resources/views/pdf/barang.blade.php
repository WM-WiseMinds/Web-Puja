<div>
    <h2>Tabel Barang</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Id</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Nama Barang</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Harga Barang</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Stok Barang</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Keterangan</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasource as $barang)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $barang->id }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $barang->nama_barang }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">Rp
                        {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $barang->stok_barang }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $barang->keterangan }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $barang->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
