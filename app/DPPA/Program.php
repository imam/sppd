<?php

namespace App\DPPA;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'dppa_program';

    protected $fillable = ['kode','nama'];

    public function kegiatan(){
        return $this->hasMany(Kegiatan::class,'program_id');
    }

    public function sub_kegiatan()
    {
        return $this->hasManyThrough(Kegiatan::class, Sub_Kegiatan::class,'program_id','kegiatan_id');
    }

}
