<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    //use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;

    //Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "tabungan";

    //protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel tabungan
    protected $fillable = [
        'nasabah_id',
        'saldo',
        'status',

    ];

    // Relasi antara model Tabungan dengan model Nasabah (Satu tabungan memiliki satu nasabah)
    public function nasabah()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh nasabah adalah tabel tabungan bisa di bilang relasi antara model Nasabah dengan model Tabungan adalah One To Many
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    // Relasi antara model Tabungan dengan model Penukaran (Satu tabungan memiliki banyak penukaran)
    public function penukaran()
    {
        //hasMany digunakan karena relasi antara model Tabungan dengan model Penukaran adalah One To Many
        return $this->hasMany(Penukaran::class, 'penukaran_id');
    }

    // Relasi antara model Tabungan dengan model HistoryTabungan (Satu tabungan memiliki banyak history tabungan)
    public function historyTabungan()
    {
        //hasMany digunakan karena relasi antara model Tabungan dengan model HistoryTabungan adalah One To Many
        return $this->hasMany(HistoryTabungan::class, 'tabungan_id');
    }

    /**
     * Method untuk memperbarui saldo tabungan.
     *
     * @param int $jumlah Jumlah uang yang akan ditambahkan atau dikurangi.
     * @param string $jenis Jenis transaksi, bisa 'debit' atau 'kredit'.
     * @param string $keterangan Keterangan untuk transaksi.
     */
    public function updateSaldo($jumlah, $jenis = 'debit', $keterangan = '')
    {
        // Jika jenis transaksi adalah 'debit'
        if ($jenis === 'debit') {
            // Menambah jumlah ke saldo
            $this->saldo += $jumlah;
        } else {
            // Jika jenis transaksi adalah 'kredit'
            // Mengurangi jumlah dari saldo
            $this->saldo -= $jumlah;
        }

        // Menyimpan perubahan ke database
        $this->save();

        // Membuat record baru di tabel history_tabungan
        $historyTabungan = new HistoryTabungan();
        $historyTabungan->tabungan_id = $this->id;
        $historyTabungan->debit = $jenis === 'debit' ? $jumlah : 0;
        $historyTabungan->kredit = $jenis === 'kredit' ? $jumlah : 0;
        $historyTabungan->keterangan = $keterangan;
        $historyTabungan->save();
    }

    // public function calculateSaldo()
    // {
    //     $saldo = $this->saldo;
    //     foreach ($this->historyTabungan as $historyTabungan) {
    //         $debit = intval($historyTabungan->debit);
    //         $kredit = intval($historyTabungan->kredit);
    //         $saldo = $saldo + $debit - $kredit;
    //         $historyTabungan->saldo = $saldo;
    //     }
    // }

    // public function formatRupiah($value)
    // {
    //     return 'Rp ' . number_format($value, 0, ',', '.');
    // }
}
