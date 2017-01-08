<?php

namespace App;

use App\Dppa\Sub_Kegiatan;
use Illuminate\Database\Eloquent\Model;

class RekeningPengajuan extends Model
{
    protected $table = 'rekening_pengajuan';

    protected $fillable = [
        'umk_id',
        'sub_kegiatan_id',
        'uraian',
        'jumlah'
    ];

    public function umk()
    {
        return $this->belongsTo(UMK::class,'umk_id');
    }

    public function sub_kegiatan()
    {
        return $this->belongsTo(Sub_Kegiatan::class,'sub_kegiatan_id');
    }
}
