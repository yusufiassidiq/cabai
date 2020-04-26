<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Target;
use App\PraProduksi;
use App\PengeluaranProduksi;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use DB;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function readTarget()
    {
        $idUser = Auth::user()->id;
        $year = Carbon::now()->format('Y'); //tahun saat ini
        $target = Target::where([
                ['user_id',$idUser],
                ['tahun',$year],
                ])->orderBy('jenis_cabai','ASC')
                ->get();
        
        return response()->json([
            'status' => 'success',
            'tahun' => $year,
            'data' => $target->toArray(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTarget(Request $request)
    {
        $idUser = Auth::user()->id;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $jenisCabai = $request->jenis_cabai;
        $check = Target::Where([
            ['tahun',$tahun],
            ['bulan',$bulan],
            ['jenis_cabai',$jenisCabai],
        ])->first();
        if($check){
            $target = Target::find($check['id']);
            $target->update([
                'tahun' => request('tahun'),
                'bulan' => request('bulan'),
                'jenis_cabai' => request('jenis_cabai'),
                'jumlah_cabai' => request('jumlah_cabai'),
            ]);
        }
        else{
            $this->validate($request, [
                'tahun' => 'required|integer|min:2020',
                'bulan' => 'required',
                'jenis_cabai' => 'required',
                'jumlah_cabai' => 'required|integer'
            ]);
            $target = new Target;
            $target->user_id = $idUser;
            $target->tahun = $request->tahun;
            $target->bulan = $request->bulan;
            $target->jenis_cabai = $request->jenis_cabai;
            $target->jumlah_cabai = $request->jumlah_cabai;
            $target->save();
        }
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTarget(Request $request, $id)
    {
        $target = Target::find($id);
        $target->update([
            'tahun' => request('tahun'),
            'bulan' => request('bulan'),
            'jenis_cabai' => request('jenis_cabai'),
            'jumlah_cabai' => request('jumlah_cabai'),
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTarget($id)
    {
        $target = Target::find($id);
        $target->delete();
        return 204;
    }
    public function getTarget()
    {
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        $year = Carbon::now()->format('Y'); //tahun saat ini
        //$month untuk label pada chart
        $month = array('Januari','Februari','Maret','April','Mei','Juni', 'Juli', 
                        'Agustus','September', 'Oktober', 'November', 'Desember');
        //membuat array kosong sebanyak bulan 
        //ex targetByMonthRawit[Januari]=0 dst
        for($i=0;$i<count($month);$i++){
            $targetByMonthRawit[$month[$i]]=0;
            $targetByMonthKeriting[$month[$i]]=0;  
            $targetByMonthBesar[$month[$i]]=0;  
        }

        //Data Target Rawit yang akan di tampilkan pada chart
        $targetRawit = Target::Where([
            ['user_id',$idUser],
            ['tahun',$year],
            ['jenis_cabai','Cabai rawit'],
        ])->get();
        //memasukan data target rawit pada database ke dalam array
        for($i=0;$i<count($targetRawit);$i++){
            $targetByMonthRawit[$targetRawit[$i]->bulan]=$targetRawit[$i]->jumlah_cabai; 
        }

        //Data Target Keriting yang akan di tampilkan pada chart
        $targetKeriting = Target::Where([
            ['user_id',$idUser],
            ['tahun',$year],
            ['jenis_cabai','Cabai keriting'],
        ])->get();
        //memasukan data target Keriting pada database ke dalam array
        for($i=0;$i<count($targetKeriting);$i++){
            $targetByMonthKeriting[$targetKeriting[$i]->bulan]=$targetKeriting[$i]->jumlah_cabai; 
        }

        //Data Target Besar yang akan di tampilkan pada chart
        $targetBesar = Target::Where([
            ['user_id',$idUser],
            ['tahun',$year],
            ['jenis_cabai','Cabai Besar'],
        ])->get();
        //memasukan data target Besar pada database ke dalam array
        for($i=0;$i<count($targetBesar);$i++){
            $targetByMonthBesar[$targetBesar[$i]->bulan]=$targetBesar[$i]->jumlah_cabai; 
        }

        //membuat array untuk menampilkan data pada chart
        for($i=0;$i<count($month);$i++){
            $data_targetRawit[$i]=$targetByMonthRawit[$month[$i]];  
            $data_targetKeriting[$i]=$targetByMonthKeriting[$month[$i]]; 
            $data_targetBesar[$i]=$targetByMonthBesar[$month[$i]];  
        }
        return response()->json([
            'month' => $month,
            'year'  => $year,
            'rawit' => $data_targetRawit,
            'keriting' => $data_targetKeriting,
            'besar' => $data_targetBesar,
        ]);
    }
    public function getPengeluaran(){
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        //mengambil id dari PraProduksi yang dimiliki oleh user
        $year = Carbon::now()->format('Y'); //tahun saat ini
        $lahan = PraProduksi::Where('user_id',$idUser)->pluck('id');
        for ($i=0;$i<count($lahan);$i++){
            $pengeluaran[$i]= PengeluaranProduksi::where('pra_produksi_id',$lahan[$i])
                    ->select('nama_pengeluaran',DB::raw('count(*) as vol'), DB::raw("SUM(jumlah_pengeluaran) as total"))
                    ->groupBy('nama_pengeluaran')
                    ->get();
            $pengeluaranByLahanPupuk[$i]=0;
            $pengeluaranByLahanAlatTani[$i]=0;  
            $pengeluaranByLahanPestisida[$i]=0; 
            $pengeluaranByLahanLainnya[$i]=0; 
            $kodeLahan[$i]=PraProduksi::Where('id',$lahan[$i])->pluck('kode_lahan');  
            for($j=0;$j<count($pengeluaran[$i]);$j++){
                if($pengeluaran[$i][$j]->nama_pengeluaran=='Pupuk'){
                    $pengeluaranByLahanPupuk[$i]=$pengeluaran[$i][$j]->total;
                }
                elseif($pengeluaran[$i][$j]->nama_pengeluaran=='Pestisida'){
                    $pengeluaranByLahanPestisida[$i]=$pengeluaran[$i][$j]->total;
                }
                elseif($pengeluaran[$i][$j]->nama_pengeluaran=='Alat Tani'){
                    $pengeluaranByLahanAlatTani[$i]=$pengeluaran[$i][$j]->total;
                }
                else{
                    $pengeluaranByLahanLainnya[$i]=$pengeluaran[$i][$j]->total;
                }
            }
        }
        return response()->json([
            'month' => $kodeLahan,
            'pupuk' => $pengeluaranByLahanPupuk,
            'alatTani' => $pengeluaranByLahanAlatTani,  
            'pestisida' => $pengeluaranByLahanPestisida, 
            'lainnya' => $pengeluaranByLahanLainnya, 
            'tahun' => $year,
        ]);
    }
    public function getPenjualan()
    {
        // $lastweek = Carbon::now()->subweek();
        // $tomorrow = Carbon::now()->addDay();
        $year= Carbon::now()->format('Y');
        $month=Carbon::now()->format('m');
        $monthYearNow = Carbon::now()->isoFormat('MMMM YYYY');
        $filter = $year . '-' . $month; //GET DATA BULAN & TAHUN YANG DIKIRIMKAN SEBAGAI PARAMETER
        $parse = Carbon::parse($filter); 
        //BUAT RANGE TANGGAL PADA BULAN TERKAIT
        $array_date = range($parse->startOfMonth()->format('d'), $parse->endOfMonth()->format('d'));
        //GET DATA TRANSAKSI BERDASARKAN BULAN & TANGGAL YANG DIMINTA.
        //GROUP / KELOMPOKKAN BERDASARKAN TANGGALNYA
        //SUM DATA AMOUNT DAN SIMPAN KE NAMA BARU YAKNI TOTAL
        $transaksi = Transaksi::where('tanggal_diterima', 'LIKE',  $filter . '%')
            ->select('tanggal_diterima',DB::raw('sum(jumlah_cabai) as jumlah'),DB::raw('sum(jumlah_cabai*harga) as total'))
            ->groupBy('tanggal_diterima')
            ->get();
        foreach($array_date as $i){
            $n_date=strlen($i) == 1 ? 0 . $i:$i;
            $date = $filter . '-' . $n_date;
            $total_transaksi=$transaksi->firstWhere('tanggal_diterima',$date);
            $data[]=[
                'tanggal_diterima' => $date,
                //if $total_transaksi true maka nilainya $total_transaksi->total selainnya 0
                'total_transaksi' => $total_transaksi ? $total_transaksi->total:0,
                'jumlah_cabai' => $total_transaksi ? $total_transaksi->jumlah:0
            ];
        }
        $lastmonth = Carbon::now()->subMonth()->addDay()->format('Y-m-d');
        $startMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        $start = Carbon::now()->subweek()->addDay()->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');
        $startTitle = Carbon::now()->subweek()->addDay()->isoFormat('Do MMMM YYYY');
        $endTitle = Carbon::now()->isoFormat('Do MMMM YYYY');
        $totalTransaksi = Transaksi::Where([
                        ['pemasok_id',$idUser],
                        ['status_permintaan','3'],
                        ['status_pengiriman','1'],
                        ['status_pemesanan','1'],
                        ])->whereBetween('tanggal_diterima', [$start, $end])
                        ->select('tanggal_diterima',DB::raw('count(*) as vol'), DB::raw("SUM(jumlah_cabai) as totalTransaksi"))
                        ->groupBy('tanggal_diterima')
                        ->get()
                        ->pluck('totalTransaksi','tanggal_diterima')
                        ->all();
        $x=0;
        for($i=Carbon::now()->subweek()->addDay();$i<=Carbon::now();$i->addDay()){
            $tanggal[$x]=$i->format('Y-m-d');
            $cabaiByDay[$x]=Transaksi::Where([
                            ['pemasok_id',$idUser],
                            ['status_permintaan','3'],
                            ['status_pengiriman','1'],
                            ['status_pemesanan','1'],
                            ['tanggal_diterima',$tanggal[$x]]
                            ])->select('jenis_cabai',DB::raw('count(*) as vol'), DB::raw("SUM(jumlah_cabai) as totalCabai"))
                            ->groupBy('jenis_cabai')
                            ->get();
            $cabaiByDayRawit[$x]=0;
            $cabaiByDayKeriting[$x]=0;
            $cabaiByDayBesar[$x]=0;
            for($j=0;$j<count($cabaiByDay[$x]);$j++){
                if($cabaiByDay[$x][$j]->jenis_cabai == 'Cabai rawit'){
                    $cabaiByDayRawit[$x]=$cabaiByDay[$x][$j]->totalCabai;
                }
                elseif($cabaiByDay[$x][$j]->jenis_cabai == 'Cabai keriting'){
                    $cabaiByDayKeriting[$x]=$cabaiByDay[$x][$j]->totalCabai;
                }
                else{
                    $cabaiByDayBesar[$x]=$cabaiByDay[$x][$j]->totalCabai;
                }
            }
            if(array_key_exists($i->format('Y-m-d'), $totalTransaksi)){
                $totalByTanggal[$x]=$totalTransaksi[$i->format('Y-m-d')];
            }
            else{
                $totalByTanggal[$x]=0;
            }
            $x++;
        }
        return response()->json([
            'transaksi' => $transaksi,
            'data' => $data,
            'monthYearNow' => $monthYearNow,
            // 'lastmonth' => $lastmonth,
            // 'totalTransaksi' => $totalTransaksi,
            'tanggal' => $tanggal,
            // 'totalByTanggal' => $totalByTanggal,
            'start' => $startTitle,
            'end' => $endTitle,
            'cabai' => $cabaiByDay,
            'rawit' => $cabaiByDayRawit,
            'keriting' => $cabaiByDayKeriting,
            'besar' => $cabaiByDayBesar,
        ]);
    }
    public function getHarga(){
        $dateNow=Carbon::now()->isoFormat('dddd, Do MMMM YYYY');
        $now=Carbon::now()->format('Y-m-d');
        $start = Carbon::now()->subweek()->subweek()->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');
        $idProdusen= User::Where('role','2')->pluck('id');
        $idPengepul= User::Where('role','3')->pluck('id');
        $idGrosir= User::Where('role','4')->pluck('id');
        $idPengecer= User::Where('role','5')->pluck('id');

        //Harga 30 Hari Terakhir
        
        $transaksiProdusenRawit=Transaksi::whereIn('pemasok_id',$idProdusen)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai rawit'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiProdusenKeriting=Transaksi::whereIn('pemasok_id',$idProdusen)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai keriting'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiProdusenBesar=Transaksi::whereIn('pemasok_id',$idProdusen)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai besar'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
            $transaksiPengepulRawit=Transaksi::whereIn('pemasok_id',$idPengepul)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai rawit'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiPengepulKeriting=Transaksi::whereIn('pemasok_id',$idPengepul)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai keriting'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiPengepulBesar=Transaksi::whereIn('pemasok_id',$idPengepul)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai besar'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiGrosirRawit=Transaksi::whereIn('pemasok_id',$idGrosir)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai rawit'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiGrosirKeriting=Transaksi::whereIn('pemasok_id',$idGrosir)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai keriting'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiGrosirBesar=Transaksi::whereIn('pemasok_id',$idGrosir)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai besar'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiPengecerRawit=Transaksi::whereIn('pemasok_id',$idPengecer)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai rawit'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiPengecerKeriting=Transaksi::whereIn('pemasok_id',$idPengecer)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai keriting'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
        $transaksiPengecerBesar=Transaksi::whereIn('pemasok_id',$idPengecer)
            -> Where([['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['jenis_cabai','Cabai besar'],
            ])->whereBetween('tanggal_diterima', [$start, $end])
            ->select('tanggal_diterima',DB::raw("ROUND(AVG(harga)) as hargaCabai"), DB::raw("SUM(jumlah_cabai) as totalCabai"))
            ->groupBy('tanggal_diterima')
            ->get();
;
        $awal = Carbon::now()->subweek()->subweek();
        for($i=0;$i<15;$i++){
            $array_date[$i]= $awal->format('Y-m-d');
            $awal=$awal->addDay();
            $rawitByDayProdusen[$i]=$transaksiProdusenRawit->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiProdusenRawit->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $keritingByDayProdusen[$i]=$transaksiProdusenKeriting->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiProdusenKeriting->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $besarByDayProdusen[$i]=$transaksiProdusenBesar->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiProdusenBesar->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $rawitByDayPengepul[$i]=$transaksiPengepulRawit->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiPengepulRawit->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $keritingByDayPengepul[$i]=$transaksiPengepulKeriting->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiPengepulKeriting->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $besarByDayPengepul[$i]=$transaksiPengepulBesar->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiPengepulBesar->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $rawitByDayGrosir[$i]=$transaksiGrosirRawit->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiGrosirRawit->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $keritingByDayGrosir[$i]=$transaksiGrosirKeriting->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiGrosirKeriting->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $besarByDayGrosir[$i]=$transaksiGrosirBesar->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiGrosirBesar->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $rawitByDayPengecer[$i]=$transaksiPengecerRawit->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiPengecerRawit->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $keritingByDayPengecer[$i]=$transaksiPengecerKeriting->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiPengecerKeriting->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
            $besarByDayPengecer[$i]=$transaksiPengecerBesar->firstWhere('tanggal_diterima',$array_date[$i]) ?
                $transaksiPengecerBesar->firstWhere('tanggal_diterima',$array_date[$i])->hargaCabai:0;
        }

        
        return response()->json([
            'rawitProdusen' => $rawitByDayProdusen,
            'keritingProdusen' => $keritingByDayProdusen,
            'besarProdusen' => $besarByDayProdusen,
            'rawitPengepul' => $rawitByDayPengepul,
            'keritingPengepul' => $keritingByDayPengepul,
            'besarPengepul' => $besarByDayPengepul,
            'rawitGrosir' => $rawitByDayGrosir,
            'keritingGrosir' => $keritingByDayGrosir,
            'besarGrosir' => $besarByDayGrosir,
            'rawitPengecer' => $rawitByDayPengecer,
            'keritingPengecer' => $keritingByDayPengecer,
            'besarPengecer' => $besarByDayPengecer,
            'date' => $array_date,
            'dateNow' => $dateNow, 
        ]);
    }
}
