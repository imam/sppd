<?php

namespace App\Dppa;

use Illuminate\Database\Eloquent\Model;

class Sub_Kegiatan extends Model
{
    protected $table = 'dppa_sub_kegiatan';
    
    protected $fillable = ['nama','jumlah_anggaran','kegiatan_id','uraian_id'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class,'kegiatan_id');
    }

    public function uraian()
    {
        return $this->belongsTo(Uraian_Sub_Kegiatan::class, 'uraian_id');
    }
}
