<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Lokasi;
use App\Transaksi;
use App\Panen;
use App\PraProduksi;
use App\Inventaris;
use App\User;
use App\Kabupaten;
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

    public function getDaerah()
    {
        $daerah = Kabupaten::all(['name','id']);
        return response()->json(
            [
                'daerah' => $daerah,
                
            ], 200);


    }
    
    public function getHarga(Request $request, $idKab, $idRole)
    {
        // Mengambil data user dari kab/kota
        $kab = Kabupaten::where('id',$idKab)->first('name');
        $idUser = Lokasi::whereIn('kabupaten',$kab)->pluck('user_id');
        $idPemasok = User::whereIn('id', $idUser)->where('role',$idRole)->pluck('id');
        $role = array('ADMIN', 'PRODUSEN', 'PENGEPUL', 'GROSIR', 'ECERAN');

        $dateNow = Carbon::now()->isoFormat('dddd, Do MMMM YYYY');
        $now = Carbon::now()->format('Y-m-d');
        $start = Carbon::now()->subweek(4)->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');
        
        $jenisCabai = array('Cabai rawit', 'Cabai keriting', 'Cabai besar');

        for ($i=0;$i<count($jenisCabai);$i++){
            $transaksiPemasok[$i] = Transaksi::whereIn('pemasok_id', $idPemasok)
                    ->Where([['status_permintaan', '3'],
                        ['status_pengiriman', '1'],
                        ['status_pemesanan', '1'],
                        ['jenis_cabai', $jenisCabai[$i]],
                    ])->whereBetween('tanggal_diterima', [$start, $end])
                    ->select('tanggal_diterima', DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai",))
                    ->groupBy('tanggal_diterima')
                    ->get();
        }

        $awal = Carbon::now()->subweek(4);
        for ($i = 0; $i < 28; $i++) {
            $array_date[$i] = $awal->format('Y-m-d');
            $awal = $awal->addDay();
            
            // k = loop berdasarkan jenis cabai
            for ($k = 0; $k < count($jenisCabai); $k++) {
                $harga = $transaksiPemasok[$k]->firstWhere('tanggal_diterima', $array_date[$i]) ?
                    $transaksiPemasok[$k]->firstWhere('tanggal_diterima', $array_date[$i])->hargaCabai : 0;
                //Harga per stakeholder, jenis cabai, dan tanggal
                $hargaByDay[$k][$i] = $harga;
            }

        }
        
        return response()->json([
            'transaksi' => $transaksiPemasok,
            'hargaHarianRawit' => $hargaByDay[0],
            'hargaHarianKeriting' => $hargaByDay[1],
            'hargaHarianBesar' => $hargaByDay[2],
            'date' => $array_date,
            'dateNow' => $dateNow,
            'kabupaten' => $kab,
            'role' => $role[$idRole - 1],
            // 'hargaMingguan' => $hargaMingguan,
        ], 200);

    }
    
    public function getProduksi(Request $request, $idKab)
    {
        // ambil data panen/produksi sesuai lokasi/kabupaten
        // $idKab = 1;
        $nameKab = Kabupaten::where('id',$idKab)->first('name');
        $userId = Lokasi::whereIn('kabupaten',$nameKab)->pluck('user_id');

        $jenisCabai = array('Cabai rawit', 'Cabai keriting', 'Cabai besar');
        
        $praProduksiRawit = PraProduksi::whereIn('user_id',$userId)->where('jenis_cabai', $jenisCabai[0])->pluck('id');
        $praProduksiKeriting = PraProduksi::whereIn('user_id',$userId)->where('jenis_cabai', $jenisCabai[1])->pluck('id');
        $praProduksiBesar = PraProduksi::whereIn('user_id',$userId)->where('jenis_cabai', $jenisCabai[2])->pluck('id');

        $panenRawit = Panen::whereIn('pra_produksi_id',$praProduksiRawit)->get();
        $panenKeriting = Panen::whereIn('pra_produksi_id',$praProduksiKeriting)->get();
        $panenBesar = Panen::whereIn('pra_produksi_id',$praProduksiBesar)->get();

        $dateNow = Carbon::now()->isoFormat('dddd, Do MMMM YYYY');
        $now = Carbon::now()->format('Y-m-d');
        $start = Carbon::now()->subweek(4)->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');

        $awal = Carbon::now()->subweek(4);
        for ($i=0;$i<28;$i++)
        {
            $array_date[$i] = $awal->format('Y-m-d');
            $awal = $awal->addDay();

            $produksiByDayRawit[$i] = $panenRawit->where('tanggal_panen',$array_date[$i])->sum('jumlah_panen');
            $produksiByDayKeriting[$i] = $panenKeriting->where('tanggal_panen',$array_date[$i])->sum('jumlah_panen');
            $produksiByDayBesar[$i] = $panenBesar->where('tanggal_panen',$array_date[$i])->sum('jumlah_panen');
        }

        return response()->json([
            'produksiRawit' => $produksiByDayRawit,
            'produksiKeriting' => $produksiByDayKeriting,
            'produksiBesar' => $produksiByDayBesar,
            'date' => $array_date,
            'dateNow' => $dateNow,
            'kabupaten' => $nameKab,
        ], 200); 
    }
    
    public function getStok(Request $request, $idKab)
    {
        $kab = Kabupaten::where('id',$idKab)->first('name');
        $idUser = Lokasi::whereIn('kabupaten',$kab)->pluck('user_id');

        $dateNow = Carbon::now()->isoFormat('dddd, Do MMMM YYYY');
        $now = Carbon::now()->format('Y-m-d');
        $start = Carbon::now()->subweek(4)->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');

        $awal = Carbon::now()->subweek(4);
        for ($i=0;$i<28;$i++)
        {
            $array_date[$i] = $awal->format('Y-m-d');
            $awal = $awal->addDay();
            
            $stokByDayRawit[$i] = Inventaris::whereIn('user_id', $idUser)
                ->where('jenis_cabai', 'Cabai rawit')
                ->whereDate('updated_at', $array_date[$i])
                ->sum('jumlah_cabai');

            $stokByDayKeriting[$i] = Inventaris::whereIn('user_id', $idUser)
                ->where('jenis_cabai', 'Cabai keriting')
                ->whereDate('updated_at', $array_date[$i])
                ->sum('jumlah_cabai');

            $stokByDayBesar[$i] = Inventaris::whereIn('user_id', $idUser)
                ->where('jenis_cabai', 'Cabai besar')
                ->whereDate('updated_at', $array_date[$i])
                ->sum('jumlah_cabai');

        }
        
        return response()->json([
            'stokRawit' => $stokByDayRawit,
            'stokKeriting' => $stokByDayKeriting,
            'stokBesar' => $stokByDayBesar,
            'date' => $array_date,
            'dateNow' => $dateNow,
            'kabupaten' => $kab,
        ], 200);
    }

    public function getProduktivitas(Request $request, $idKab)
    {
        $nameKab = Kabupaten::where('id',$idKab)->first('name');
        $userId = Lokasi::whereIn('kabupaten',$nameKab)->pluck('user_id');

        $jenisCabai = array('Cabai rawit', 'Cabai keriting', 'Cabai besar');
        
        // get pra produksi
        $praProduksiRawit = PraProduksi::whereIn('user_id',$userId)->where('jenis_cabai', $jenisCabai[0])->get();
        $praProduksiKeriting = PraProduksi::whereIn('user_id',$userId)->where('jenis_cabai', $jenisCabai[1])->get();
        $praProduksiBesar = PraProduksi::whereIn('user_id',$userId)->where('jenis_cabai', $jenisCabai[2])->get();

        $panenRawit = Panen::whereIn('pra_produksi_id',$praProduksiRawit->pluck('id'))->get();
        $panenKeriting = Panen::whereIn('pra_produksi_id',$praProduksiKeriting->pluck('id'))->get();
        $panenBesar = Panen::whereIn('pra_produksi_id',$praProduksiBesar->pluck('id'))->get();

        $dateNow = Carbon::now()->isoFormat('dddd, Do MMMM YYYY');
        $now = Carbon::now()->format('Y-m-d');
        $start = Carbon::now()->subweek(4)->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');

        $awal = Carbon::now()->subweek(4);
        for ($i=0;$i<28;$i++)
        {
            $array_date[$i] = $awal->format('Y-m-d');
            $awal = $awal->addDay();

            $panenRawit = Panen::whereIn('pra_produksi_id',$praProduksiRawit->pluck('id'))->where('tanggal_panen',$array_date[$i]);
            $panenKeriting = Panen::whereIn('pra_produksi_id',$praProduksiKeriting->pluck('id'))->where('tanggal_panen',$array_date[$i]);
            $panenBesar = Panen::whereIn('pra_produksi_id',$praProduksiBesar->pluck('id'))->where('tanggal_panen',$array_date[$i]);
            
            // $idPraProduksi[$i] = $panenRawit -> value('pra_produksi_id') ;
            
            $luasRawit[$i] = PraProduksi::where('id',$panenRawit -> value('pra_produksi_id'))->value('luas_lahan');
            $luasKeriting[$i] = PraProduksi::where('id',$panenKeriting -> value('pra_produksi_id'))->value('luas_lahan');
            $luasBesar[$i] = PraProduksi::where('id',$panenBesar -> value('pra_produksi_id'))->value('luas_lahan');

            $produksiByDayRawit[$i] = $panenRawit->sum('jumlah_panen');
            $produksiByDayKeriting[$i] = $panenKeriting->sum('jumlah_panen');
            $produksiByDayBesar[$i] = $panenBesar->sum('jumlah_panen');

            $produktivitasByDayRawit[$i] = $luasRawit[$i] ? round($produksiByDayRawit[$i]/$luasRawit[$i]) : 0;
            $produktivitasByDayKeriting[$i] = $luasKeriting[$i] ? round($produksiByDayKeriting[$i]/$luasKeriting[$i]) : 0;
            $produktivitasByDayBesar[$i] = $luasBesar[$i] ? round($produksiByDayBesar[$i]/$luasBesar[$i]) : 0;

        }

        return response()->json([
            'produktivitasRawit' => $produktivitasByDayRawit,
            'produktivitasKeriting' => $produktivitasByDayKeriting,
            'produktivitasBesar' => $produktivitasByDayBesar,
            'date' => $array_date,
            'dateNow' => $dateNow,
            'kabupaten' => $nameKab,
        ], 200); 
    }
    
}
