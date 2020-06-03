<?php

use Illuminate\Database\Seeder;
use App\PraProduksi;
use App\User;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PraProduksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role',2)->pluck('id');
        $jenis_cabai=array("Cabai rawit","Cabai keriting","Cabai besar");
        foreach($jenis_cabai as $cabai){
            foreach ($users as $user){
                $lahan = new PraProduksi;
                $lahan->kode_lahan = strtoupper($cabai[(strpos($cabai," ")) + 1]).rand(100,999);
                $lahan->jenis_cabai = $cabai;
                $lahan->tanggal_tanam = "2020-05-01";
                $lahan->luas_lahan = rand(1,2);

                $lahan->user()->associate($user);
                $lahan->save();
            }
        }               
    }
}
