<style>
    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: auto;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .divider {
        border-top: 1px solid #000;
        width: 100%;
        margin-top: 20px;
    }

    .footer {
        position: relative;
    }

    .signature-space {
        height: 80px;
    }

    .footer-text {
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    .block {
        display: block;
    }
</style>

<div class="text-center">
    <h2>Daftar Tabungan</h2>
</div>
<div class="divider"></div>
<div class="text-right">
    <p>Tanggal Dibuat: {{ now()->format('d F Y') }}</p>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Nasabah</th>
            <th>Saldo</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datasource as $tabungan)
            <tr>
                <td>{{ $tabungan->id }}</td>
                <td>{{ $tabungan->nasabah->user->name }}</td>
                <td>Rp {{ number_format($tabungan->saldo, 0, ',', '.') }}</td>
                <td>{{ $tabungan->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="signature-space"></div>

<div class="footer">
    <div class="footer-text">
        <div class="block">Cau Blayu, {{ now()->format('d F Y') }}</div>
        <div class="block">Bank Sampah Desa Cau Blayu</div>
        <div class="signature-space"></div>
        <div class="block">Manajer</div>
    </div>
</div>
