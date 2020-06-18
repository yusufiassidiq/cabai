<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Target;
use Faker\Generator as Faker;

$factory->define(Target::class, function (Faker $faker) {
    return [
        // 'bulan' => $faker->words(3, true)
        'bulan' => $faker->randomElement($array = array('Januari','Februari','Maret','April','Mei')),
        'tahun' => '2020',
        'jenis_cabai' => $faker->randomElement($array = array('Cabai rawit', 'Cabai keriting', 'Cabai besar')),
        'jumlah_cabai' => $faker->numberBetween($min = 20, $max=100),
    ];
});