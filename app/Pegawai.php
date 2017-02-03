<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table =  'pegawai';

    protected $fillable = ['nama','NIP','jabatan','status','pangkat','NPWP','user_id'];

    protected static function boot()
    {
        parent::boot();
    }

    public function scopeActive($query)
    {
        return $query->where('status','!=','Nonaktif');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
