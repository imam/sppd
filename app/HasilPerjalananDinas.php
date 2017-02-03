<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilPerjalananDinas extends Model
{
    protected $table = 'hasil_perjalanan_dinas';
    
    protected $fillable = ['hasil','file','perjalanan_dinas_id'];

    public function perjalanan_dinas()
    {
        return $this->belongsTo(PerjalananDinas::class,'perjalanan_dinas_id');
    }
}
