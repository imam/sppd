<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasTransaksiPerjalananDinas extends Model
{
    protected $table = 'petugas_transaksi_perjalanan_dinas';

    protected $fillable  = [
        'nomor_surat',
        'transaksi_perjalanan_dinas_id',
        'pegawai_id',
    ];

    public function transaksi_perjalanan_dinas()
    {
        return $this->belongsTo(TransaksiPerjalananDinas::class, 'transaksi_perjalanan_dinas_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'pegawai_id');
     }
}
