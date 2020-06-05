<?php

use Illuminate\Database\Seeder;
use App\Panen;
use App\PraProduksi;
use App\User;
use App\Inventaris;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PanenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = User::where('role',2)->pluck('id');
        $awal = Carbon::now()->subweek(4);

        for ($d=0; $d<4; $d++){
            $date = $awal->format('Y-m-d');
            $awal = $awal->addWeek();
            
            foreach ($userId as $user){
                $praProduksiId = PraProduksi::where('user_id',$user)->pluck('id');

                foreach($praProduksiId as $praProduksi){
                    $panen = new Panen;
                    $panen->pra_produksi_id = $praProduksi;
                    $jumlahPanen = rand(70,100);
                    $panen->jumlah_panen = $jumlahPanen;
                    $panen->tanggal_panen = $date;
                    $panen->user_id = $user;
                    $panen->save();

                    $jenis_cabai = PraProduksi::find($praProduksi)->jenis_cabai;
                    $inventaris = Inventaris::where('jenis_cabai',$jenis_cabai)->where('user_id',$user)->get();
                    foreach ($inventaris as $inv ) {
                        $jumlahCabai = $inv->jumlah_cabai;
                        $inv->update([
                            'jumlah_cabai' => $jumlahCabai + $jumlahPanen,
                        ]);
                    }
                }
            }  
        }
    }
}
