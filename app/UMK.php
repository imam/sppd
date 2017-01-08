<?php

namespace App;

use App\Dppa\Kegiatan;
use Illuminate\Database\Eloquent\Model;

class UMK extends Model
{
    protected $table = 'umk';

    protected $fillable = [
        'kegiatan_id',
        'pejabat_pelaksana_teknis_kegiatan_pegawai_id',
        'pejabat_pengadaan_barang_dan_jasa_pegawai_id',
        'pejabat_kuasa_penggunaan_anggaran_pegawai_id'
    ];

    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class,'kegiatan_id');
    }

    public function pejabat_pelaksana_teknis_kegiatan_pegawai()
    {
        return $this->belongsTo(Pegawai::class,'pejabat_pelaksana_teknis_kegiatan_pegawai_id');
    }

    public function pejabat_pengadaan_barang_dan_jasa_pegawai()
    {
        return $this->belongsTo(Pegawai::class,'pejabat_pengadaan_barang_dan_jasa_pegawai_id');
    }

    public function pejabat_kuasa_penggunaan_anggaran_pegawai_id()
    {
        return $this->belongsTo(Pegawai::class,'pejabat_kuasa_penggunaan_anggaran_pegawai_id');
    }

    public function rekening_pengajuan()
    {
        return $this->hasMany(RekeningPengajuan::class,'umk_id');
    }
}
