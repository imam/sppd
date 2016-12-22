<?php

namespace App\Dppa;

use Illuminate\Database\Eloquent\Model;

class Uraian_Sub_Kegiatan extends Model
{
    protected $fillable = ['kode_rekening','uraian'];

    protected $table = 'dppa_uraian_sub_kegiatan';

    public function sub_kegiatan(){
        return $this->hasMany(Sub_Kegiatan::class,'uraian_id');
    }
}
