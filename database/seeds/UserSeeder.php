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
        $role = 2;
        foreach ($daerah as $kab){
            $replaceSpace = preg_replace('/\s+/', '_', $kab);

            // User
            $user = new User;
            $user->name = "USER ".$kab;
            $user->email = "user_".strtolower($replaceSpace)."@test.com";
            $user->password = Hash::make('asd');
            $user->role = $role;
            $user->status = 1;
            $user->fotosk = Str::random(5);
            $user->save();
            // inc role
            if ($role == 6) $role = 2;
            else $role = $role + 1;

            // Lokasi
            $lokasi = new Lokasi([
                'kabupaten' => $kab,
                'kecamatan' => 'Test',
                'kelurahan' => 'Test',
                'user_id'=>$user->id
            ]);
            $lokasi->user()->associate($user);
            $lokasi->save();
            
            // Inventori
            $jenis_cabai=array("Cabai besar","Cabai rawit","Cabai keriting");
            foreach ($jenis_cabai as $i){
                $inventori = new Inventaris([
                    'jenis_cabai'=>$i,
                    'jumlah_cabai'=>0,
                    'harga'=>0
                ]);
                $inventori->user()->associate($user);
                $inventori->save();
            }
        }
    }
}
