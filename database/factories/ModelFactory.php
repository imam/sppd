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
