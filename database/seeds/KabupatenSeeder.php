<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daerah = array("KABUPATEN BOGOR","KABUPATEN SUKABUMI","KABUPATEN CIANJUR","KABUPATEN BANDUNG","KABUPATEN GARUT","KABUPATEN TASIKMALAYA","KABUPATEN CIAMIS","KABUPATEN KUNINGAN","KABUPATEN CIREBON","KABUPATEN MAJALENGKA","KABUPATEN SUMEDANG","KABUPATEN INDRAMAYU","KABUPATEN SUBANG","KABUPATEN PURWAKARTA","KABUPATEN KARAWANG","KABUPATEN BEKASI","KABUPATEN BANDUNG BARAT","KABUPATEN PANGANDARAN","KOTA BOGOR","KOTA SUKABUMI","KOTA BANDUNG","KOTA CIREBON","KOTA BEKASI","KOTA DEPOK","KOTA CIMAHI","KOTA TASIKMALAYA","KOTA BANJAR");
        for ($i=0;$i<count($daerah);$i++){
            DB::table('kabupaten')->insert([
                'id' => $i+1,
                'name' => $daerah[$i]
            ]);
        }
    }
}
