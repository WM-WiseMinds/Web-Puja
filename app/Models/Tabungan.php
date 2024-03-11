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

    public function updateSaldoTable()
    {
        $saldo = 0;

        foreach ($this->historyTabungan as $historyTabungan) {
            $debit = intval($historyTabungan->debit);
            $kredit = intval($historyTabungan->kredit);
            $saldo += $debit - $kredit;
        }

        // Update the saldo field in the Tabungan model
        $this->update(['saldo' => $saldo]);
    }


    public function updateSaldo($jumlah, $jenis = 'debit', $operation = 'increment', $keterangan = '', $created_at = null)
    {
        // Try to find an existing history record
        $historyTabungan = HistoryTabungan::where('tabungan_id', $this->id)
            ->where('keterangan', $keterangan)
            ->first();

        if ($historyTabungan) {
            if ($jenis === 'debit') {
                if ($operation === 'increment') {
                    $historyTabungan->increment('debit', $jumlah);
                } else {
                    $historyTabungan->decrement('debit', $jumlah);
                }
            } else {
                if ($operation === 'increment') {
                    $historyTabungan->increment('kredit', $jumlah);
                } else {
                    $historyTabungan->decrement('kredit', $jumlah);
                }
            }

            if ($historyTabungan->debit == 0 && $historyTabungan->kredit == 0) {
                $historyTabungan->delete();
            }
        } else {
            // Create a new history record if it doesn't exist
            if ($operation === 'increment') {
                $historyTabungan = new HistoryTabungan();
                $historyTabungan->tabungan_id = $this->id;
                $historyTabungan->debit = $jenis === 'debit' ? $jumlah : 0;
                $historyTabungan->kredit = $jenis === 'kredit' ? $jumlah : 0;
                $historyTabungan->keterangan = $keterangan;
                $historyTabungan->created_at = $created_at;
                $historyTabungan->save();
            }
        }

        $this->updateSaldoTable();
    }

    public function updateHargaBarangPenukaran($keteranganPenukaran, $hargaBarangBaru)
    {
        $historyTabungan = HistoryTabungan::where('tabungan_id', $this->id)
            ->where('keterangan', $keteranganPenukaran)
            ->first();

        if ($historyTabungan) {
            $historyTabungan->kredit = $hargaBarangBaru;
            $historyTabungan->save();
        } else {
            $this->updateSaldo($hargaBarangBaru, 'kredit', 'increment', $keteranganPenukaran);
        }
    }
}
