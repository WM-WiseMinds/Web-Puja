<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTabungan extends Model
{
    use HasFactory;

    protected $table = 'history_tabungan';

    protected $fillable = [
        'tabungan_id',
        'debit',
        'kredit',
        'keterangan',
    ];

    public function tabungan()
    {
        return $this->belongsTo(Tabungan::class);
    }
}
