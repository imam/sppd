<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasPembayaran extends Model
{
    protected $table = 'petugas_pembayaran';

    protected $fillable = [
        'pembayaran_id',
        'pegawai_id',
        'uang',
        'transport',
        'penginapan'
    ];

    public function pembayaran(){
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
