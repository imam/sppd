<?php

namespace App\Dppa;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'dppa_kegiatan';

    protected $fillable = ['kode','nama','program_id'];

    protected $appends = ['jumlah_anggaran'];

    public function program()
    {
        return $this->belongsTo(Program::class,'program_id');
    }

    public function sub_kegiatan()
    {
        return $this->hasMany(Sub_Kegiatan::class, 'kegiatan_id');
    }

    public function getJumlahAnggaranAttribute()
    {
        $jumlah_anggaran =  [];
        foreach ($this->sub_kegiatan as $sub_kegiatan){
            $jumlah_anggaran[] = $sub_kegiatan->jumlah_anggaran;
        }
        return array_sum($jumlah_anggaran);
    }
}
