<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'tahun_anggaran' => '2017',
        'remember_token' => str_random(10),
    ];
});


$factory->define(\App\DPPA\Program::class,function(\Faker\Generator $faker){
    return [
        'kode' => $faker->numberBetween(50000,1000000),
        'nama' => $faker->sentence('3')
    ];
});

$factory->define(\App\Dppa\Kegiatan::class,function(\Faker\Generator $faker){
    return [
        'kode' => $faker->numberBetween(50000,1000000),
        'nama' => $faker->sentence(3)
    ];
});

$factory->define(\App\Dppa\Sub_Kegiatan::class,function(\Faker\Generator $faker){
    return [
        'nama' => $faker->sentence(3),
        'jumlah_anggaran' => $faker->numberBetween(50000000,100000000)
    ];
});

$factory->define(\App\Dppa\Uraian_Sub_Kegiatan::class,function(\Faker\Generator $faker){
    return [
        'kode_rekening' => $faker->numberBetween(500000,1000000),
        'uraian' => $faker->sentence(7)
    ];
});

$factory->define(\App\UMK::class,function(\Faker\Generator $faker){
    return [
        'kegiatan_id' => \App\Dppa\Kegiatan::inRandomOrder()->first()->id,
        'pejabat_pelaksana_teknis_kegiatan_pegawai_id' => \App\Pegawai::inRandomOrder()->first()->id,
        'pejabat_pengadaan_barang_dan_jasa_pegawai_id' => \App\Pegawai::inRandomOrder()->first()->id,
        'pejabat_kuasa_pengguna_anggaran_pegawai_id' => \App\Pegawai::inRandomOrder()->first()->id,
    ];
});

$factory->define(\App\RekeningPengajuan::class,function (\Faker\Generator $faker){
    return [
        'uraian' => $faker->sentence(20),
        'jumlah' => $faker->numberBetween(500000,1000000)
    ];
});

$factory->define(\App\PerjalananDinas::class, function(\Faker\Generator $faker){
    $tanggal_berangkat = \Carbon\Carbon::now()->addDays($faker->numberBetween(0,365));
    $tanggal_pulang = $tanggal_berangkat->addDays($faker->numberBetween(0,30));
    $kegiatan =  \App\Dppa\Kegiatan::inRandomOrder()->first()->id;
    return [
        'kegiatan_id' => $kegiatan,
        'sub_kegiatan_id' => \App\Dppa\Kegiatan::find($kegiatan)->sub_kegiatan()->inRandomOrder()->first()->id,
        'tempat_berangkat' => $faker->address,
        'tempat_tujuan' => $faker->address,
        'tanggal_berangkat' => $tanggal_berangkat,
        'tanggal_pulang' => $tanggal_pulang,
        'referensi_perjalanan' => $faker->sentence(8),
        'nomor_referensi' => $faker->numberBetween(10000,99999),
        'tanggal_referensi' => \Carbon\Carbon::now(),
        'jenis_perjalanan'=> $faker->randomElement(['undangan','terjadwal']),
        'tingkat_biaya_perjalanan_dinas'=> $faker->randomElement(['A','B','C']),
        'maksud_perjalanan' => $faker->sentence(10),
        'alat_angkutan_yang_digunakan' => $faker->randomElement(['Motor','Mobil','Pesawat','Gojeg']),
        'keterangan_lain_lain' => $faker->sentence(10),
        'pejabat_pelaksana_teknis_kegiatan' => \App\Pegawai::inRandomOrder()->first()->id,
        'pejabat_pengadaan_barang_dan_jasa' => \App\Pegawai::inRandomOrder()->first()->id,
        'pejabat_kuasa_pengguna_anggaran' => \App\Pegawai::inRandomOrder()->first()->id,
    ];
});

$factory->define(\App\TransaksiPerjalananDinas::class, function(\Faker\Generator $faker){
    return [
        'perjalanan_dinas_id' => \App\PerjalananDinas::inRandomOrder()->first()->id,
        'nomor_surat'=> $faker->numberBetween(10000,99999)
    ];
});

$factory->define(\App\PetugasTransaksiPerjalananDinas::class,function(\Faker\Generator $faker){
    return [
        'nomor_surat'=> $faker->numberBetween(10000,99999),
        'pegawai_id'=> \App\Pegawai::inRandomOrder()->first()->id
    ];
});

$factory->define(\App\PejabatTransaksiPerjalananDinas::class, function (\Faker\Generator $faker){
    return [
        'NIP' => $faker->numberBetween(10000,99999),
        'nama' => $faker->name(),
        'jabatan' => $faker->randomElement(['CEO','Kepo','Bangeet','Yes'])
    ];
});

$factory->define(\App\Pembayaran::class, function(\Faker\Generator $faker){
    return[
        'perjalanan_dinas_id' => \App\PerjalananDinas::inRandomOrder()->first()->id,
    ];
});

$factory->define(\App\PetugasPembayaran::class, function (\Faker\Generator $faker){
    return [
        'pegawai_id' => \App\Pegawai::inRandomOrder()->first()->id,
        'uang' => $faker->numberBetween(50000000,100000000),
        'transport' => $faker->numberBetween(50000000,100000000),
        'penginapan' => $faker->numberBetween(50000000,100000000)
    ];
});
