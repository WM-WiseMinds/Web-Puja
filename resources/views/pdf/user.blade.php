<div>
    <h2>Tabel User</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Id</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Nama</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Email</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Role Name</th>
                <th style="border: 1px solid black; padding: 5px; text-align: left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasource as $user)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $user->id }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $user->name }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $user->email }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $user->role_name }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $user->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
