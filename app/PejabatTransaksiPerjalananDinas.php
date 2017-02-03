<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PejabatTransaksiPerjalananDinas extends Model
{
    protected $table = 'pejabat_transaksi_perjalanan_dinas';

    protected $fillable = [
        'transaksi_perjalanan_dinas_id',
        'nip',
        'nama',
        'jabatan'
    ];

    public function transaksi_perjalanan_dinas()
    {
        return $this->belongsTo(TransaksiPerjalananDinas::class, 'transaksi_perjalanan_dinas_id');
    }
}
