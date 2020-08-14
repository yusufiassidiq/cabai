<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Str;

class HargaSeeder extends Seeder
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

        $jenis_cabai='Cabai besar';

        $awal = Carbon::now()->subweek(4);

        for ($d=0; $d<30; $d++){
            $date = $awal->format('Y-m-d');
            $awal = $awal->addDay();

            foreach($pengepul as $peng){
                $transaksi = new Transaksi;
                $transaksi->user_id = $peng;
                $transaksi->pemasok_id = $produsen[rand(0,count($produsen)-1)];
                $transaksi->jumlah_cabai = rand(100,1000);
                $transaksi->jenis_cabai = $jenis_cabai;
                $transaksi->harga = rand(15000,35000);
                $transaksi->tanggal_diterima = $date; 
                $transaksi->tanggal_pengiriman = $date;
                $transaksi->status_permintaan = 3;
                $transaksi->status_pengiriman = 1;
                $transaksi->status_pemesanan = 1;
                $transaksi->save();
            }

            foreach($grosir as $gros){
                $transaksi = new Transaksi;
                $transaksi->user_id = $gros;
                $transaksi->pemasok_id = $pengepul[rand(0,count($pengepul)-1)];
                $transaksi->jumlah_cabai = rand(100,1000);
                $transaksi->jenis_cabai = $jenis_cabai;
                $transaksi->harga = rand(20000,40000);
                $transaksi->tanggal_diterima = $date; 
                $transaksi->tanggal_pengiriman = $date;
                $transaksi->status_permintaan = 3;
                $transaksi->status_pengiriman = 1;
                $transaksi->status_pemesanan = 1;
                $transaksi->save();
            }

            foreach($pengecer as $ecer){
                $transaksi = new Transaksi;
                $transaksi->user_id = $peng;
                $transaksi->pemasok_id = $grosir[rand(0,count($grosir)-1)];
                $transaksi->jumlah_cabai = rand(100,1000);
                $transaksi->jenis_cabai = $jenis_cabai;
                $transaksi->harga = rand(25000,45000);
                $transaksi->tanggal_diterima = $date; 
                $transaksi->tanggal_pengiriman = $date;
                $transaksi->status_permintaan = 3;
                $transaksi->status_pengiriman = 1;
                $transaksi->status_pemesanan = 1;
                $transaksi->save();
            }

            foreach($konsumen as $kons){
                $transaksi = new Transaksi;
                $transaksi->user_id = $kons;
                $transaksi->pemasok_id = $pengecer[rand(0,count($pengecer)-1)];
                $transaksi->jumlah_cabai = rand(100,1000);
                $transaksi->jenis_cabai = $jenis_cabai;
                $transaksi->harga = rand(30000,50000);
                $transaksi->tanggal_diterima = $date; 
                $transaksi->tanggal_pengiriman = $date;
                $transaksi->status_permintaan = 3;
                $transaksi->status_pengiriman = 1;
                $transaksi->status_pemesanan = 1;
                $transaksi->save();
            }
        }
    }
}
