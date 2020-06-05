<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Lokasi;
use App\Inventaris;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daerah = array("KABUPATEN BOGOR","KABUPATEN SUKABUMI","KABUPATEN CIANJUR","KABUPATEN BANDUNG","KABUPATEN GARUT","KABUPATEN TASIKMALAYA","KABUPATEN CIAMIS","KABUPATEN KUNINGAN","KABUPATEN CIREBON","KABUPATEN MAJALENGKA","KABUPATEN SUMEDANG","KABUPATEN INDRAMAYU","KABUPATEN SUBANG","KABUPATEN PURWAKARTA","KABUPATEN KARAWANG","KABUPATEN BEKASI","KABUPATEN BANDUNG BARAT","KABUPATEN PANGANDARAN","KOTA BOGOR","KOTA SUKABUMI","KOTA BANDUNG","KOTA CIREBON","KOTA BEKASI","KOTA DEPOK","KOTA CIMAHI","KOTA TASIKMALAYA","KOTA BANJAR");
        $roleName = array("PRODUSEN", "PENGEPUL", "GROSIR","PENGECER","KONSUMEN");

        for ($i=1;$i<=2;$i++){
            foreach ($daerah as $kab){
                // fetch kab/kot
                $sub1 = substr($kab,0,3);
                //fetch nama kab/kot
                $sub2 = preg_replace('/\s+/', '_', substr($kab, strpos($kab, " ") + 1));
                //ex = kab_bogor
                $nameKab = $sub1."_".$sub2;
                
                for ($r=1; $r<=count($roleName); $r++){
                // User
                    $user = new User;
                    // ex = PENGEPUL KAB BOGOR 1
                    $user->name = $roleName[$r-1]." ".$kab." ".$i;
                    // ex = pengepul_kab_bogor_1@test.com
                    $user->email = strtolower($roleName[$r-1])."_".strtolower($nameKab)."_".$i."@test.com";
                    $user->password = Hash::make('asd');
                    $user->role = $r+1;
                    $user->status = 1;
                    $user->fotosk = Str::random(5);
                    $user->save();

                // Lokasi
                    $lokasi = new Lokasi([
                        'kabupaten' => $kab,
                        'kecamatan' => Str::random(8),
                        'kelurahan' => Str::random(8),
                        'user_id'=>$user->id
                    ]);
                    $lokasi->user()->associate($user);
                    $lokasi->save();
                    
                // Inventori
                    $jenis_cabai=array("Cabai besar","Cabai rawit","Cabai keriting");
                    foreach ($jenis_cabai as $c){
                        $inventori = new Inventaris([
                            'jenis_cabai'=>$c,
                            'jumlah_cabai'=>0,
                            'harga'=>0
                        ]);
                        $inventori->user()->associate($user);
                        $inventori->save();
                    }
                }
            }       
        }
    }
}
