<?php

use Illuminate\Database\Seeder;
use App\Kemitraan;
use App\User;

class KemitraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produsen = User::where('role',2)->pluck('id');
        $pengepul = User::where('role',3)->pluck('id');
        $grosir = User::where('role',4)->pluck('id');
        $pengecer = User::where('role',5)->pluck('id');
        $konsumen = User::where('role',6)->pluck('id');

        foreach($produsen as $prod){
            $kemitraan = new Kemitraan;
            $kemitraan->status = 1;
            $kemitraan->action_user = $prod;
            $kemitraan->user1_id = $prod;
            $kemitraan->user2_id = $pengepul[rand(0,count($pengepul)-1)];
            $kemitraan->flag = 0;
            $kemitraan->save();
        }

        foreach($pengepul as $peng){
            $kemitraan = new Kemitraan;
            $kemitraan->status = 1;
            $kemitraan->action_user = $peng;
            $kemitraan->user1_id = $peng;
            $kemitraan->user2_id = $grosir[rand(0,count($grosir)-1)];
            $kemitraan->flag = 0;
            $kemitraan->save();
        }
        
        foreach($grosir as $gros){
            $kemitraan = new Kemitraan;
            $kemitraan->status = 1;
            $kemitraan->action_user = $gros;
            $kemitraan->user1_id = $gros;
            $kemitraan->user2_id = $pengecer[rand(0,count($pengecer)-1)];
            $kemitraan->flag = 0;
            $kemitraan->save();
        }

        foreach($pengecer as $ecer){
            $kemitraan = new Kemitraan;
            $kemitraan->status = 1;
            $kemitraan->action_user = $ecer;
            $kemitraan->user1_id = $ecer;
            $kemitraan->user2_id = $konsumen[rand(0,count($konsumen)-1)];
            $kemitraan->flag = 0;
            $kemitraan->save();
        }
    }
}
