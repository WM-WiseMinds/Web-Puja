<div>
    <h2>Tabel Nasabah</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Id</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Nama</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Alamat</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">No HP</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Jenis Kelamin</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasource as $nasabah)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $nasabah->id }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $nasabah->user->name }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $nasabah->alamat }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $nasabah->no_hp }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $nasabah->jenis_kelamin }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $nasabah->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
