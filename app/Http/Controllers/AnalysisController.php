<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use App\Target;
use App\PraProduksi;
use App\Panen;
use App\PengeluaranProduksi;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use DB;

class AnalysisController extends Controller
{
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
    public function getFilterTarget()
    {
        $roleUser = Auth::user()->role;
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        $year = Target::Where('user_id',$idUser)
        ->orderBy('tahun','ASC')
        ->pluck('tahun')
        ->first();
        $yearNow= Carbon::now()->format('Y');
        if($year<$yearNow){
            $year=range($year,$yearNow);
        }
        else
            $year=[$year];
        return response()->json([
            'roleUser' => $roleUser,
            'tahun' => $year,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTarget(Request $request, $tahun)
    {
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        $roleUser = Auth::user()->role;
        $month = array('Januari','Februari','Maret','April','Mei','Juni', 'Juli', 
                        'Agustus','September', 'Oktober', 'November', 'Desember');
        //untuk ditampikan pada tabel
        $targetByMonth=Target::where([
                ['user_id',$idUser],
                ['tahun',$tahun],
                ])
                ->orderByRaw("FIELD(bulan,'Januari','Februari','Maret','April','Mei','Juni',
                'Juli', 'Agustus','September', 'Oktober', 'November', 'Desember')ASC")
                ->paginate(9);
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
            ['tahun',$tahun],
            ['jenis_cabai','Cabai rawit'],
        ])->get();
        //memasukan data target rawit pada database ke dalam array
        for($i=0;$i<count($targetRawit);$i++){
            $targetByMonthRawit[$targetRawit[$i]->bulan]=$targetRawit[$i]->jumlah_cabai; 
        }

        //Data Target Keriting yang akan di tampilkan pada chart
        $targetKeriting = Target::Where([
            ['user_id',$idUser],
            ['tahun',$tahun],
            ['jenis_cabai','Cabai keriting'],
        ])->get();
        //memasukan data target Keriting pada database ke dalam array
        for($i=0;$i<count($targetKeriting);$i++){
            $targetByMonthKeriting[$targetKeriting[$i]->bulan]=$targetKeriting[$i]->jumlah_cabai; 
        }

        //Data Target Besar yang akan di tampilkan pada chart
        $targetBesar = Target::Where([
            ['user_id',$idUser],
            ['tahun',$tahun],
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
            'status' => 'success',
            'data' => $targetByMonth,
            'month' => $month,
            'year'  => $tahun,
            'roleUser' => $roleUser,
            'rawit' => $data_targetRawit,
            'keriting' => $data_targetKeriting,
            'besar' => $data_targetBesar,
        ]);
    }
    public function getPengeluaran(){
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        $roleUser = Auth::user()->role;
        //mengambil id dari PraProduksi yang dimiliki oleh user
        $year = Carbon::now()->format('Y'); //tahun saat ini
        $lahan = PraProduksi::Where('user_id',$idUser)->pluck('id');
        $pengeluaranByLahanPupuk=null;
        $pengeluaranByLahanAlatTani=null;  
        $pengeluaranByLahanPestisida=null; 
        $pengeluaranByLahanLainnya=null; 
        $kodeLahan=null;  
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
            'roleUser' => $roleUser,
            'lahan' => $kodeLahan,
            'pupuk' => $pengeluaranByLahanPupuk,
            'alatTani' => $pengeluaranByLahanAlatTani,  
            'pestisida' => $pengeluaranByLahanPestisida, 
            'lainnya' => $pengeluaranByLahanLainnya, 
            'tahun' => $year,
        ]);
    }
    public function getFilterPenjualan()
    {
        $roleUser = Auth::user()->role;
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        $tahun = Transaksi::Where([['pemasok_id',$idUser],
        ['status_permintaan','3'],
        ['status_pengiriman','1'],
        ['status_pemesanan','1'],
        ])
        ->orderBy('tanggal_diterima','ASC')
        ->pluck('tanggal_diterima')
        ->first();
        $year=Carbon::createFromFormat('Y-m-d',$tahun)->year;
        $yearNow= Carbon::now()->format('Y');
        if($year<$yearNow){
            $year=range($year,$yearNow);
        }
        else
            $year=[$year];
        return response()->json([
            'roleUser' => $roleUser,
            'tahun' => $year,
        ]);
    }
    public function getPenjualan(Request $request, $bulan, $tahun)
    {
        $roleUser = Auth::user()->role;
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        $year= Carbon::now()->format('Y');
        $month=Carbon::now()->format('m');
        //TABEL
        $filter = $tahun . '-' . $bulan; //GET DATA BULAN & TAHUN YANG DIKIRIMKAN SEBAGAI PARAMETER
        $parse = Carbon::parse($filter); 
        $monthiso = $parse->isoFormat('MMMM');
        $monthYearNow = $parse->isoFormat('MMMM YYYY');
        //BUAT RANGE TANGGAL PADA BULAN TERKAIT
        $array_date = range($parse->startOfMonth()->format('d'), $parse->endOfMonth()->format('d'));
        //GET DATA TRANSAKSI BERDASARKAN BULAN & TANGGAL YANG DIMINTA.
        //GROUP / KELOMPOKKAN BERDASARKAN TANGGALNYA
        //SUM DATA AMOUNT DAN SIMPAN KE NAMA BARU YAKNI TOTAL
        $transaksi = Transaksi::where([
                ['pemasok_id',$idUser],
                ['status_permintaan','3'],
                ['status_pengiriman','1'],
                ['status_pemesanan','1'],
                ])
                ->select('jumlah_cabai','harga','jenis_cabai','tanggal_diterima')
                ->addSelect(DB::raw('jumlah_cabai*harga as total'))->get();
        foreach($array_date as $i){
            $n_date=strlen($i) == 1 ? 0 . $i:$i;
            $date = $filter . '-' . $n_date;
            $total_transaksi=$transaksi->where('tanggal_diterima',$date);
            //Data untuk tabel
            $data[]=[
                'tanggal_diterima' => $i . '/' . $monthiso. '/' . $tahun,
                'tanggal' => $i,
                //if $total_transaksi true maka nilainya $total_transaksi->total selainnya 0
                'total_transaksi' => $total_transaksi->sum('total'),
                'jumlah_cabai' => $total_transaksi->sum('jumlah_cabai'),
                'jumlah_rawit' => $total_transaksi->where('jenis_cabai','Cabai rawit')->sum('jumlah_cabai'),
                'jumlah_keriting' => $total_transaksi->where('jenis_cabai','Cabai keriting')->sum('jumlah_cabai'),
                'jumlah_besar' => $total_transaksi->where('jenis_cabai','Cabai besar')->sum('jumlah_cabai'),    
            ];
        }
        // Data untuk grafik
        $tanggal=array_column($data, 'tanggal');
        $startTitle = reset($tanggal) . ' ' . $monthiso . ' ' . $tahun;
        $endTitle = end($tanggal) . ' ' . $monthiso . ' ' . $tahun;
        // $totalTransaksi = array_column($data, 'total_transaksi');
        $cabaiByDayRawit = array_column($data, 'jumlah_rawit');
        $cabaiByDayKeriting = array_column($data, 'jumlah_keriting');
        $cabaiByDayBesar = array_column($data, 'jumlah_besar');
        return response()->json([
            'roleUser' => $roleUser,
            'transaksi' => $transaksi,
            'data' => $data,
            'monthYearNow' => $monthYearNow,
            'tanggal' => $tanggal,
            'start' => $startTitle,
            'end' => $endTitle,
            // 'cabai' => $cabaiByDay,
            // 'totalTransaksi' => $totalTransaksi,
            'rawit' => $cabaiByDayRawit,
            'keriting' => $cabaiByDayKeriting,
            'besar' => $cabaiByDayBesar,
        ]);
    }
    public function getHarga(){
        $roleUser = Auth::user()->role;
        $dateNow=Carbon::now()->isoFormat('dddd, Do MMMM YYYY');
        $now=Carbon::now()->format('Y-m-d');
        $start = Carbon::now()->subweek()->subweek()->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');
        $idProdusen= User::Where('role','2')->pluck('id');
        $idPengepul= User::Where('role','3')->pluck('id');
        $idGrosir= User::Where('role','4')->pluck('id');
        $idPengecer= User::Where('role','5')->pluck('id');
        $idKonsumen= User::Where('role','6')->pluck('id');
        
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
        $konsumRawit=Transaksi::whereIn('user_id', $idKonsumen)
        -> Where([['status_permintaan','3'],
        ['status_pengiriman','1'],
        ['status_pemesanan','1'],
        ['jenis_cabai','Cabai rawit'],
        ])->whereBetween('tanggal_diterima', [$start, $end])
        ->select('user_id','pemasok_id','jumlah_cabai')
        ->get();
        $konsumRawitProdusen=$konsumRawit->whereIn('pemasok_id', $idProdusen)->sum('jumlah_cabai');
        $konsumRawitPengepul=$konsumRawit->whereIn('pemasok_id', $idPengepul)->sum('jumlah_cabai');
        $konsumRawitGrosir=$konsumRawit->whereIn('pemasok_id', $idGrosir)->sum('jumlah_cabai');
        $konsumRawitPengecer=$konsumRawit->whereIn('pemasok_id', $idPengecer)->sum('jumlah_cabai');
        
        $konsumKeriting=Transaksi::whereIn('user_id', $idKonsumen)
        -> Where([['status_permintaan','3'],
        ['status_pengiriman','1'],
        ['status_pemesanan','1'],
        ['jenis_cabai','Cabai keriting'],
        ])->whereBetween('tanggal_diterima', [$start, $end])
        ->select('user_id','pemasok_id','jumlah_cabai')
        ->get();
        $konsumKeritingProdusen=$konsumKeriting->whereIn('pemasok_id', $idProdusen)->sum('jumlah_cabai');
        $konsumKeritingPengepul=$konsumKeriting->whereIn('pemasok_id', $idPengepul)->sum('jumlah_cabai');
        $konsumKeritingGrosir=$konsumKeriting->whereIn('pemasok_id', $idGrosir)->sum('jumlah_cabai');
        $konsumKeritingPengecer=$konsumKeriting->whereIn('pemasok_id', $idPengecer)->sum('jumlah_cabai');

        $konsumBesar=Transaksi::whereIn('user_id', $idKonsumen)
        -> Where([['status_permintaan','3'],
        ['status_pengiriman','1'],
        ['status_pemesanan','1'],
        ['jenis_cabai','Cabai besar'],
        ])->whereBetween('tanggal_diterima', [$start, $end])
        ->select('user_id','pemasok_id','jumlah_cabai')
        ->get();
        $konsumBesarProdusen=$konsumBesar->whereIn('pemasok_id', $idProdusen)->sum('jumlah_cabai');
        $konsumBesarPengepul=$konsumBesar->whereIn('pemasok_id', $idPengepul)->sum('jumlah_cabai');
        $konsumBesarGrosir=$konsumBesar->whereIn('pemasok_id', $idGrosir)->sum('jumlah_cabai');
        $konsumBesarPengecer=$konsumBesar->whereIn('pemasok_id', $idPengecer)->sum('jumlah_cabai');
        // $terjualProdusenBesar = array_sum(array_column($transaksiProdusenBesar->toArray(), 'totalCabai'));
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
            // 'test' => $test,
            'roleUser' => $roleUser,
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
            'konsumRawitProdusen' => $konsumRawitProdusen,
            'konsumKeritingProdusen' => $konsumKeritingProdusen,
            'konsumBesarProdusen' => $konsumBesarProdusen,
            'konsumRawitPengepul' => $konsumRawitPengepul,
            'konsumKeritingPengepul' => $konsumKeritingPengepul,
            'konsumBesarPengepul' => $konsumBesarPengepul,
            'konsumRawitGrosir' => $konsumRawitGrosir,
            'konsumKeritingGrosir' => $konsumKeritingGrosir,
            'konsumBesarGrosir' => $konsumBesarGrosir,
            'konsumRawitPengecer' => $konsumRawitPengecer,
            'konsumKeritingPengecer' => $konsumKeritingPengecer,
            'konsumBesarPengecer' => $konsumBesarPengecer,
            'date' => $array_date,
            'dateNow' => $dateNow, 
        ]);
    }
    public function getSummaryProdusen(){
        $roleUser = Auth::user()->role;
        $idUser = Auth::user()->id;
        $year= Carbon::now()->format('Y');
        $month=Carbon::now()->format('m');
        $bulan = Carbon::now()->isoFormat('MMMM');
        //Target bulan ini
        $targetMonthNow=Target::Where([['user_id',$idUser],
            ['bulan', $bulan],
            ['tahun', $year],
            ])
            ->pluck('jumlah_cabai','jenis_cabai')
            ->all();
        $filter = $year . '-' . $month; //GET DATA BULAN & TAHUN YANG DIKIRIMKAN SEBAGAI PARAMETER
        $parse = Carbon::parse($filter); 
        //BUAT RANGE TANGGAL PADA BULAN TERKAIT
        //GET DATA TRANSAKSI BERDASARKAN BULAN & TANGGAL YANG DIMINTA.
        //GROUP / KELOMPOKKAN BERDASARKAN TANGGALNYA
        //SUM DATA AMOUNT DAN SIMPAN KE NAMA BARU YAKNI TOTAL
        $transaksiMonthNow=Transaksi::Where([['pemasok_id',$idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  $filter . '%']
            ])
            ->select('jenis_cabai',DB::raw("sum(jumlah_cabai) as total"))
            ->groupBy('jenis_cabai')
            ->pluck('total','jenis_cabai')
            ->all();
        //Harga tertinggi
        $maxHarga=Transaksi::Where([['pemasok_id',$idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  $filter . '%']
            ])
            
            ->orderBy('harga','DESC')
            ->first();
        if($maxHarga){
            $maxHargaQty=(int)$maxHarga->harga;
            $maxHargaJenis=$maxHarga->jenis_cabai;
        }
        else{
            $maxHargaQty='-';
            $maxHargaJenis='-';
        }
        // Penjualan Terbanyak
        $maxJumlah=Transaksi::Where([['pemasok_id',$idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  $filter . '%']
            ])
            ->select('jenis_cabai',DB::raw("sum(jumlah_cabai) as jumlah"))
            ->groupBy('jenis_cabai')
            ->orderBy('jumlah','DESC')
            ->first();
        if($maxJumlah){
            $maxJumlahQty=(int)$maxJumlah->jumlah;
            $maxJumlahJenis=$maxJumlah->jenis_cabai;
        }
        else{
            $maxJumlahQty='-';
            $maxJumlahJenis='-';
        }
        // Penjualan Terendah
        $minJumlah=Transaksi::Where([['pemasok_id',$idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  $filter . '%']
            ])
            ->select('jenis_cabai',DB::raw("sum(jumlah_cabai) as jumlah"))
            ->groupBy('jenis_cabai')
            ->orderBy('jumlah','ASC')
            ->first();
        if($minJumlah){
                $minJumlahQty=(int)$minJumlah->jumlah;
                $minJumlahJenis=$minJumlah->jenis_cabai;
            }
        else{
            $minJumlahQty='-';
            $minJumlahJenis='-';
        }
        //Produktivitas Tertinggi
        $idLahan=PraProduksi::Where('user_id',$idUser)
        ->pluck('id');
        // ->all();
        $jmlPanen=Panen::Where('user_id',$idUser)
                    ->select('pra_produksi_id',DB::raw("sum(jumlah_panen) as jumlah"))
                    ->groupBy('pra_produksi_id')
                    ->pluck('jumlah','pra_produksi_id')
                    ->all();
        $luasLahan=PraProduksi::Where('user_id',$idUser)
        ->pluck('luas_lahan','id')
        ->all();
        $maxProduktivitas=0;
        foreach($idLahan as $id){
            if(array_key_exists($id,$jmlPanen)){
                if(array_key_exists($id,$luasLahan)){
                    $produktivitas=((int)$jmlPanen[$id])/$luasLahan[$id];
                        if($maxProduktivitas<$produktivitas){
                            $maxProduktivitas=$produktivitas;
                            $maxProduktivitasId=$id;
                        }
                }
            }
        }
        if($maxProduktivitas==0)
            $maxKodeLahan="-";
        else{
            $maxKodeLahan=PraProduksi::where('id',$maxProduktivitasId)
            ->pluck('kode_lahan')
            ->first();
        }   
        $jenisCabai=['Cabai rawit','Cabai keriting','Cabai besar'];
        // Transaksi bulan ini terhadap target bulan ini
        foreach($jenisCabai as $jenis){
            if(array_key_exists($jenis, $targetMonthNow)){
                if(array_key_exists($jenis, $transaksiMonthNow)){
                    //ada target dan transaksi
                    $terjual=(int)$transaksiMonthNow[$jenis];
                    // $gap=$targetMonthNow[$jenis]-$terjual;
                    $gap=$targetMonthNow[$jenis];
                    $ach=ROUND(($transaksiMonthNow[$jenis]*100)/$targetMonthNow[$jenis]);
                    if($ach>100)
                        $ach=100;
                }
                else{
                    //belum ada transaksi
                    $terjual=0;
                    $gap=$targetMonthNow[$jenis];
                    $ach=0;
                }
            }
            //belum ada target 
            else{
                $terjual='Belum Ada Target';
                $gap='';
                $ach=0;
            }
            //memasukan data menjadi object
            $penjualanTarget[]=[
                'jenis' => $jenis,
                'terjual' => $terjual,
                'gap' => $gap,
                'ach' => $ach,
            ];
        }
        $start = Carbon::now()->subMonths(5)->startOfMonth();
        $startTargetRealisasi = $start->isoFormat('Do MMMM YYYY');
        for($i=0;$i<6;$i++){
            $range=$start->format('Y-m');
            $last6Month[$i]=$start->isoFormat('MMMM');
            $pengeluaran[$i]=PengeluaranProduksi::where([
                ['user_id',$idUser],
                ['created_at', 'LIKE',  $range . '%']
            ])->select(DB::raw("sum(jumlah_pengeluaran) as jumlah_pengeluaran"))
            ->pluck('jumlah_pengeluaran')
            ->first();
            $transaksi[$i]=Transaksi::Where([['pemasok_id',$idUser],
                ['status_permintaan','3'],
                ['status_pengiriman','1'],
                ['status_pemesanan','1'],
                ['tanggal_diterima', 'LIKE',  $range . '%']
                ])
                ->select(DB::raw("sum(jumlah_cabai) as jumlah_cabai"), DB::raw("sum(jumlah_cabai*harga) as jumlah"))
                ->first();
            $target[$i]=Target::Where([['user_id',$idUser],
                ['bulan', $last6Month[$i]],
                ['tahun', $year],
                ])
                ->select(DB::raw("sum(jumlah_cabai) as jumlah_target"))
                ->pluck('jumlah_target')
                ->first();
            if($target[$i]==null){
                $target[$i]=0;
            }
            else{
                $target[$i]=(int)$target[$i];
            }
            if($pengeluaran[$i]==null){
                $pengeluaran[$i]=0;
            }
            else{
                $pengeluaran[$i]=(int)($pengeluaran[$i]/1000);
            }
            if($transaksi[$i]->jumlah==null || $transaksi[$i]->jumlah_cabai==null){
                $pemasukan[$i]=0;
                $penjualan[$i]=0;
            }
            else{
                $pemasukan[$i]=(int)($transaksi[$i]->jumlah/1000);
                $penjualan[$i]=(int)$transaksi[$i]->jumlah_cabai;
            }
            if($i==5){
                $pemasukanTotal=$pemasukan[$i]*1000;
                $pengeluaranTotal=$pengeluaran[$i]*1000;
                $labaTotal=$pemasukanTotal-$pengeluaranTotal;
                $terjualTotal=$penjualan[$i];
                $labaLastMonth=$pemasukan[$i-1]*1000-$pengeluaran[$i-1]*1000;
                if($pemasukan[$i-1]){
                $mtdPemasukan=ROUND(($pemasukan[$i]-$pemasukan[$i-1])*100/$pemasukan[$i-1]);
                $mtdPengeluaran=ROUND(($pengeluaran[$i]-$pengeluaran[$i-1])*100/$pengeluaran[$i-1]);
                $mtdLaba=ROUND(($labaTotal-$labaLastMonth)*100/$labaLastMonth);
                }
                else if($pemasukan[$i-1]==0){
                    $mtdPemasukan=(string)(($pemasukan[$i]-$pemasukan[$i-1])*1000);
                    $mtdPengeluaran=(string)(($pengeluaran[$i]-$pengeluaran[$i-1])*1000);
                    if($labaLastMonth<0)
                        $mtdLaba=(string)($labaLastMonth+$labaTotal);  
                    else    
                        $mtdLaba=(string)($labaTotal-$labaLastMonth);
                }
                if($penjualan[$i-1]){
                    $mtdTerjual=ROUND(($penjualan[$i]-$penjualan[$i-1])*100/$penjualan[$i-1]);
                }
                else{
                    $mtdTerjual=(string)($penjualan[$i]-$penjualan[$i-1]);
                }
            }
            $start=$start->addMonth()->startOfMonth();
        }
        $endTargetRealisasi = $start->subMonth()->endOfMonth()->isoFormat('Do MMMM YYYY');
        return response()->json([
            'roleUser' => $roleUser,
            'bulan' => $bulan,
            'year' => $year,
            'start' => $startTargetRealisasi,
            'end' => $endTargetRealisasi,
            'penjualan' => $penjualan,
            'maxJumlahQty' => $maxJumlahQty,
            'maxJumlahJenis' => $maxJumlahJenis,
            'minJumlahQty' => $minJumlahQty,
            'minJumlahJenis' => $minJumlahJenis,
            'maxHargaQty' => $maxHargaQty,
            'maxHargaJenis' => $maxHargaJenis,
            'maxProduktivitas' => $maxProduktivitas,
            'maxKodeLahan' => $maxKodeLahan,
            'penjualanTarget' => $penjualanTarget,
            'pemasukanTotal' => $pemasukanTotal,
            'mtdPemasukan' => $mtdPemasukan,
            'pengeluaranTotal' => $pengeluaranTotal,
            'mtdPengeluaran' => $mtdPengeluaran,
            'labaTotal' => $labaTotal,
            'mtdLaba' => $mtdLaba,
            'terjualTotal' => $terjualTotal,
            'mtdTerjual' => $mtdTerjual,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'target' => $target,
            'last6Month' => $last6Month,
            'targetByJenisCabai' => $targetMonthNow,
        ]);
    }
    public function getPasokan()
    {
        $roleUser = Auth::user()->role;
        $idUser = Auth::user()->id;
        $range= Carbon::now()->subweek()->format('Y-m');
        $pasokan = Transaksi::Where([
            ['user_id', $idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            // ['jenis_cabai','Cabai rawit']
            ['tanggal_diterima', 'LIKE',  $range . '%']
        ])->select('pemasok_id',DB::raw("sum(jumlah_cabai) as total"))
        ->groupBy('pemasok_id')
        ->orderBy('total','DESC')
        ->get();
        for($i=0;$i<count($pasokan);$i++){
            $pemasok[$i]=User::find($pasokan[$i]->pemasok_id)->name;
            $idPemasok[$i]=$pasokan[$i]->pemasok_id;
        }
        if(count($pasokan)==0){
            $pemasok=null;
            $totalRawit=null;
            $totalKeriting=null;
            $totalBesar=null;
        }
        else{
            $pasokanRawit = Transaksi::whereIn('pemasok_id',$idPemasok)
            ->Where([['user_id', $idUser],
                ['status_permintaan','3'],
                ['status_pengiriman','1'],
                ['status_pemesanan','1'],
                ['jenis_cabai','Cabai rawit'],
                ['tanggal_diterima', 'LIKE',  $range . '%']
            ])->select('pemasok_id',DB::raw("sum(jumlah_cabai) as total"))
            ->groupBy('pemasok_id')
            ->pluck('total','pemasok_id')
            ->all();
            $pasokanKeriting = Transaksi::whereIn('pemasok_id',$idPemasok)
            ->Where([['user_id', $idUser],
                ['status_permintaan','3'],
                ['status_pengiriman','1'],
                ['status_pemesanan','1'],
                ['jenis_cabai','Cabai keriting'],
                ['tanggal_diterima', 'LIKE',  $range . '%']
            ])->select('pemasok_id',DB::raw("sum(jumlah_cabai) as total"))
            ->groupBy('pemasok_id')
            ->pluck('total','pemasok_id')
            ->all();
            $pasokanBesar = Transaksi::whereIn('pemasok_id',$idPemasok)
            ->Where([['user_id', $idUser],
                ['status_permintaan','3'],
                ['status_pengiriman','1'],
                ['status_pemesanan','1'],
                ['jenis_cabai','Cabai besar'],
                ['tanggal_diterima', 'LIKE',  $range . '%']
            ])->select('pemasok_id',DB::raw("sum(jumlah_cabai) as total"))
            ->groupBy('pemasok_id')
            ->pluck('total','pemasok_id')
            ->all();
            $c=0;
            foreach($idPemasok as $id){
                if(array_key_exists($id,$pasokanRawit))
                    $totalRawit[]=$pasokanRawit[$id];
                else
                    $totalRawit[]=0;
                if(array_key_exists($id,$pasokanKeriting))
                    $totalKeriting[]=$pasokanKeriting[$id];
                else
                    $totalKeriting[]=0;
                if(array_key_exists($id,$pasokanBesar))
                    $totalBesar[]=$pasokanBesar[$id];
                else
                    $totalBesar[]=0;
            }
        }
        $rangePasokan= Carbon::now()->isoFormat('MMMM YYYY');
        return response()->json([
            'test' => $pasokanRawit,
            'rangePasokan' => $rangePasokan,
            'pemasok' => $pemasok,
            'totalRawit' => $totalRawit,
            'totalKeriting' => $totalKeriting,
            'totalBesar' => $totalBesar,
            'roleUser' => $roleUser,
        ]);
    }
    public function getSummaryOthers(){
        $roleUser = Auth::user()->role;
        $idUser = Auth::user()->id;
        $year= Carbon::now()->format('Y');
        $month=Carbon::now()->format('m');
        $bulan = Carbon::now()->isoFormat('MMMM');
        //Target bulan ini
        $targetMonthNow=Target::Where([['user_id',$idUser],
            ['bulan', $bulan],
            ['tahun', $year],
            ])
            ->pluck('jumlah_cabai','jenis_cabai')
            ->all();
        $filter = $year . '-' . $month; //GET DATA BULAN & TAHUN YANG DIKIRIMKAN SEBAGAI PARAMETER
        $parse = Carbon::parse($filter); 
        //BUAT RANGE TANGGAL PADA BULAN TERKAIT
        //GET DATA TRANSAKSI BERDASARKAN BULAN & TANGGAL YANG DIMINTA.
        //GROUP / KELOMPOKKAN BERDASARKAN TANGGALNYA
        //SUM DATA AMOUNT DAN SIMPAN KE NAMA BARU YAKNI TOTAL
        $transaksiMonthNow=Transaksi::Where([['pemasok_id',$idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  $filter . '%']
            ])
            ->select('jenis_cabai',DB::raw("sum(jumlah_cabai) as total"))
            ->groupBy('jenis_cabai')
            ->pluck('total','jenis_cabai')
            ->all();
        //Harga tertinggi
        $maxHarga=Transaksi::Where([['pemasok_id',$idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  $filter . '%']
            ])
            
            ->orderBy('harga','DESC')
            ->first();
        if($maxHarga){
            $maxHargaQty=(int)$maxHarga->harga;
            $maxHargaJenis=$maxHarga->jenis_cabai;
        }
        else{
            $maxHargaQty='-';
            $maxHargaJenis='-';
        }
        // Penjualan Terbanyak
        $maxJumlah=Transaksi::Where([['pemasok_id',$idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  $filter . '%']
            ])
            ->select('jenis_cabai',DB::raw("sum(jumlah_cabai) as jumlah"))
            ->groupBy('jenis_cabai')
            ->orderBy('jumlah','DESC')
            ->first();
        if($maxJumlah){
            $maxJumlahQty=(int)$maxJumlah->jumlah;
            $maxJumlahJenis=$maxJumlah->jenis_cabai;
        }
        else{
            $maxJumlahQty='-';
            $maxJumlahJenis='-';
        }
        // Penjualan Terendah
        $minJumlah=Transaksi::Where([['pemasok_id',$idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  $filter . '%']
            ])
            ->select('jenis_cabai',DB::raw("sum(jumlah_cabai) as jumlah"))
            ->groupBy('jenis_cabai')
            ->orderBy('jumlah','ASC')
            ->first();
        if($minJumlah){
                $minJumlahQty=(int)$minJumlah->jumlah;
                $minJumlahJenis=$minJumlah->jenis_cabai;
            }
        else{
            $minJumlahQty='-';
            $minJumlahJenis='-';
        }
        //Pemasok Terbanyak
        $maxPemasok = Transaksi::Where([
            ['user_id', $idUser],
            ['status_permintaan','3'],
            ['status_pengiriman','1'],
            ['status_pemesanan','1'],
            ['tanggal_diterima', 'LIKE',  '2020-05' . '%']
        ])->select('pemasok_id',DB::raw("sum(jumlah_cabai) as total"))
        ->groupBy('pemasok_id')
        ->orderBy('total','DESC')
        ->first();
        if($maxPemasok){
            $maxPemasokQty=(int)$maxPemasok->total;
            $maxPemasokName=User::find($maxPemasok->pemasok_id)->name;
        }
        else{
            $maxPemasokQty='-';
            $maxPemasokName='-';
        }
        // $maxPasokan=
        $jenisCabai=['Cabai rawit','Cabai keriting','Cabai besar'];
        // Transaksi bulan ini terhadap target bulan ini
        foreach($jenisCabai as $jenis){
            if(array_key_exists($jenis, $targetMonthNow)){
                if(array_key_exists($jenis, $transaksiMonthNow)){
                    //ada target dan transaksi
                    $terjual=(int)$transaksiMonthNow[$jenis];
                    $gap=$targetMonthNow[$jenis]-$terjual;
                    $ach=ROUND(($transaksiMonthNow[$jenis]*100)/$targetMonthNow[$jenis]);
                    if($ach>100)
                        $ach=100;
                }
                else{
                    //belum ada transaksi
                    $terjual=0;
                    $gap=$targetMonthNow[$jenis];
                    $ach=0;
                }
            }
            //belum ada target 
            else{
                $terjual='Belum Ada Target';
                $gap='';
                $ach=0;
            }
            //memasukan data menjadi object
            $penjualanTarget[]=[
                'jenis' => $jenis,
                'terjual' => $terjual,
                'gap' => $gap,
                'ach' => $ach,
            ];
        }
        $start = Carbon::now()->subMonths(5)->startOfMonth();
        $startTargetRealisasi = $start->isoFormat('Do MMMM YYYY');
        for($i=0;$i<6;$i++){
            $range=$start->format('Y-m');
            $last6Month[$i]=$start->isoFormat('MMMM');
            $pengeluaran[$i]=PengeluaranProduksi::where([
                ['user_id',$idUser],
                ['created_at', 'LIKE',  $range . '%']
            ])->select(DB::raw("sum(jumlah_pengeluaran) as jumlah_pengeluaran"))
            ->pluck('jumlah_pengeluaran')
            ->first();
            $modal[$i] = Transaksi::Where([
                ['user_id', $idUser],
                ['status_permintaan','3'],
                ['status_pengiriman','1'],
                ['status_pemesanan','1'],
                ['tanggal_diterima', 'LIKE',  $range . '%']
            ])->select(DB::raw("sum(jumlah_cabai*harga) as jumlah_modal"))
            ->pluck('jumlah_modal')
            ->first();
            $transaksi[$i]=Transaksi::Where([['pemasok_id',$idUser],
                ['status_permintaan','3'],
                ['status_pengiriman','1'],
                ['status_pemesanan','1'],
                ['tanggal_diterima', 'LIKE',  $range . '%']
                ])
                ->select(DB::raw("sum(jumlah_cabai) as jumlah_cabai"), DB::raw("sum(jumlah_cabai*harga) as jumlah"))
                ->first();
            $target[$i]=Target::Where([['user_id',$idUser],
                ['bulan', $last6Month[$i]],
                ['tahun', $year]
                ])
                ->select(DB::raw("sum(jumlah_cabai) as jumlah_target"))
                ->pluck('jumlah_target')
                ->first();
            if($target[$i]==null){
                $target[$i]=0;
            }
            else{
                $target[$i]=(int)$target[$i];
            }
            if($modal[$i]==null){
                $modal[$i]=0;
            }
            else{
                $modal[$i]=(int)($modal[$i]/1000);
            }
            if($transaksi[$i]->jumlah==null || $transaksi[$i]->jumlah_cabai==null){
                $pemasukan[$i]=0;
                $penjualan[$i]=0;
            }
            else{
                $pemasukan[$i]=(int)($transaksi[$i]->jumlah/1000);
                $penjualan[$i]=(int)$transaksi[$i]->jumlah_cabai;
            }
            if($i==5){
                $pemasukanTotal=$pemasukan[$i]*1000;
                $modalTotal=$modal[$i]*1000;
                $labaTotal=$pemasukanTotal-$modalTotal;
                $terjualTotal=$penjualan[$i];
                $labaLastMonth=$pemasukan[$i-1]*1000-$modal[$i-1]*1000;
                if($pemasukan[$i-1]){
                $mtdPemasukan=ROUND(($pemasukan[$i]-$pemasukan[$i-1])*100/$pemasukan[$i-1]);
                $mtdModal=ROUND(($modal[$i]-$modal[$i-1])*100/$modal[$i-1]);
                $mtdLaba=ROUND(($labaTotal-$labaLastMonth)*100/$labaLastMonth);
                }
                else if($pemasukan[$i-1]==0){
                    $mtdPemasukan=(string)(($pemasukan[$i]-$pemasukan[$i-1])*1000);
                    $mtdModal=(string)(($modal[$i]-$modal[$i-1])*1000);
                    if($labaLastMonth<0)
                        $mtdLaba=(string)($labaLastMonth+$labaTotal);  
                    else  
                        $mtdLaba=(string)($labaTotal-$labaLastMonth);
                }
                if($penjualan[$i-1]){
                    $mtdTerjual=ROUND(($penjualan[$i]-$penjualan[$i-1])*100/$penjualan[$i-1]);
                }
                else{
                    $mtdTerjual=(string)($penjualan[$i]-$penjualan[$i-1]);
                }
            }
            $start=$start->addMonth()->startOfMonth();
        }
        $endTargetRealisasi = $start->subMonth()->endOfMonth()->isoFormat('Do MMM YYYY');
        return response()->json([
            'roleUser' => $roleUser,
            'bulan' => $bulan,
            'year' => $year,
            'start' => $startTargetRealisasi,
            'end' => $endTargetRealisasi,
            'penjualan' => $penjualan,
            'maxJumlahQty' => $maxJumlahQty,
            'maxJumlahJenis' => $maxJumlahJenis,
            'minJumlahQty' => $minJumlahQty,
            'minJumlahJenis' => $minJumlahJenis,
            'maxHargaQty' => $maxHargaQty,
            'maxHargaJenis' => $maxHargaJenis,
            'maxPemasokName' => $maxPemasokName,
            'maxPemasokQty' => $maxPemasokQty,
            'penjualanTarget' => $penjualanTarget,
            'pemasukanTotal' => $pemasukanTotal,
            'mtdPemasukan' => $mtdPemasukan,
            'modalTotal' => $modalTotal,
            'mtdModal' => $mtdModal,
            'labaTotal' => $labaTotal,
            'mtdLaba' => $mtdLaba,
            'terjualTotal' => $terjualTotal,
            'mtdTerjual' => $mtdTerjual,
            'pemasukan' => $pemasukan,
            'modal' => $modal,
            'target' => $target,
            'last6Month' => $last6Month,
            'targetByJenisCabai' => $targetMonthNow,
        ]);
    }
}
