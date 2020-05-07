<?php

namespace App\Http\Controllers;

use App\Lokasi;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use DB;

class AnalysisHomeController extends Controller
{
    public function index()
    {
        //
    }

    public function getUserCount()
    {
        $year = Carbon::now()->format('Y'); //tahun saat ini
        $role_user = array('Produsen', 'Pengepul', 'Grosir', 'Pengecer', 'Konsumen');
        $jml_user = User::count() - 1; //-1 admin

        for ($i = 0; $i < count($role_user); $i++) {
            $data_user[$i] = User::where('role', $i + 2)->where('status', 1)->count();
        }

        return response()->json([
            'role_user' => $role_user,
            'year' => $year,
            'total_user' => $jml_user,
            'user' => $data_user,
        ]);
    }

    public function getAllUserLocation()
    {

        $listUser = User::where('status', 1)->where('id', '<>', 1)->get();
        foreach ($listUser as $i) {
            $i->lokasiKabupaten = $i->lokasi()->first()->kabupaten;
            $i->lokasiKecamatan = $i->lokasi()->first()->kecamatan;
            $i->lokasiKelurahan = $i->lokasi()->first()->kelurahan;
        }
        return response()->json(
            [
                'status' => 'success',
                'lokasi' => $listUser->toArray(),
            ], 200);
    }

    public function getAllHarga()
    {
        // $test = Carbon::now()->subweek()->format('Y-m-d');
        $dateNow = Carbon::now()->isoFormat('dddd, Do MMMM YYYY');
        $now = Carbon::now()->format('Y-m-d');
        $start = Carbon::now()->subweek(4)->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');
        $idProdusen = User::Where('role', '2')->pluck('id');
        $idPengepul = User::Where('role', '3')->pluck('id');
        $idGrosir = User::Where('role', '4')->pluck('id');
        $idPengecer = User::Where('role', '5')->pluck('id');
        $idUser = array($idProdusen, $idPengepul, $idGrosir, $idPengecer);
        $jenisCabai = array('Cabai rawit', 'Cabai keriting', 'Cabai besar');

        // i = loop berdasarkan stakeholder (0:produsen, 1:pengepul, 2:grosir, 3:pengecer)
        for ($i = 0; $i < count($idUser); $i++) {
            // j = loop berdasarkan jenis cabai (0:rawit, 1:keriting, 2:besar)
            for ($j = 0; $j < count($jenisCabai); $j++) {
                // $test[$i][$j] = array($idUser[$i], $jenisCabai[$j]);
                $transaksiUser[$i][$j] = Transaksi::whereIn('pemasok_id', $idUser[$i])
                    ->Where([['status_permintaan', '3'],
                        ['status_pengiriman', '1'],
                        ['status_pemesanan', '1'],
                        ['jenis_cabai', $jenisCabai[$j]],
                    ])->whereBetween('tanggal_diterima', [$start, $end])
                    ->select('tanggal_diterima', DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
                    ->groupBy('tanggal_diterima')
                    ->get();
            }

        }

        //Harga 30 Hari Terakhir
        $awal = Carbon::now()->subweek(4);
        $idDay = $sumPrice = $x = 0;
        for ($i = 0; $i < 28; $i++) {
            $array_date[$i] = $awal->format('Y-m-d');
            $awal = $awal->addDay();
            
            // j = loop berdasarkan stakeholder
            for ($j = 0; $j < count($idUser); $j++) {
                // k = loop berdasarkan jenis cabai
                for ($k = 0; $k < count($jenisCabai); $k++) {
                    $harga = $transaksiUser[$j][$k]->firstWhere('tanggal_diterima', $array_date[$i]) ?
                        $transaksiUser[$j][$k]->firstWhere('tanggal_diterima', $array_date[$i])->hargaCabai : 0;
                    //Harga per stakeholder, jenis cabai, dan tanggal
                    $hargaByDay[$j][$k][$i] = $harga;
                    if($harga>0){
                        $sumPrice = $sumPrice + $harga;
                        
                        $idDay = $idDay + 1;
                    }
                }
            }

            // Rata-rata harga mingguan

            if(($i + 1) % 7 == 0){
                if($idDay == 0) $hargaMingguan[$x] = array($awal ->format('Y-m-d'),0);
                else $hargaMingguan[$x] = array($awal ->format('Y-m-d'), $sumPrice / $idDay);
                $x = $x+1;
            }

        }
        
        
        // $hargaByDay[i][j] = i: (0:produsen, 1:pengepul, 2:grosir, 3:pengecer), j: (0:rawit, 1:keriting, 2:besar)

        return response()->json([
            'rawitProdusen' => $hargaByDay[0][0],
            'keritingProdusen' => $hargaByDay[0][1],
            'besarProdusen' => $hargaByDay[0][2],
            'rawitPengepul' => $hargaByDay[1][0],
            'keritingPengepul' => $hargaByDay[1][1],
            'besarPengepul' => $hargaByDay[1][2],
            'rawitGrosir' => $hargaByDay[2][0],
            'keritingGrosir' => $hargaByDay[2][1],
            'besarGrosir' => $hargaByDay[2][2],
            'rawitPengecer' => $hargaByDay[3][0],
            'keritingPengecer' => $hargaByDay[3][1],
            'besarPengecer' => $hargaByDay[3][2],
            'date' => $array_date,
            'dateNow' => $dateNow,
            // 'test' => $test,
            'transaksiUser' => $transaksiUser[0][0],
            'hargaByDay' => $hargaByDay[0][0],
            'cek' => $hargaMingguan,

        ]);
    }

}
