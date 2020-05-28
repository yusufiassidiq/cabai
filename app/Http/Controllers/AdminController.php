<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use DB;
use Carbon\Carbon;
use App\Inventaris;
use App\Target;

class AdminController extends Controller
{
    public function delete($id)
    {
        $user = User::find($id);
        $praProduksis = $user->praProduksi->load('pengeluaranProduksi','panen');
        foreach($praProduksis as $i){
            $i->pengeluaranProduksi()->delete();
            $i->panen()->delete();
        }
        $user->lokasi()->delete();
        $user->praProduksi()->delete();
        DB::table('kemitraan')->orWhere(function($query)use($id){
            $query->orWhere('user2_id',$id)->orWhere('user1_id',$id);
        })->delete();
        $user->transaksi()->delete();
        $user->inventaris()->delete();
        $user->delete();
        return 204;
    }
    public function terima($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return response()->json(['status' => 'success'], 200);
        // dd($user->status);
    }
    public function tolak($id)
    {
        $user = User::find($id);
        $user->status = 2;
        $user->save();
        $user->inventaris()->delete();
        return response()->json(['status' => 'success'], 200);
    }
    public function dashboardAdmin()
    {
        $jml_user = User::count() - 1; //-1 admin
        $user_tervalidasi = User::where('status', 1)->count() - 1;// -1 admin
        $user_blm_divalidasi = User::where('status',0)->count();
        $user_ditolak = User::where('status',2)->count();

        $data = ["total_user" => $jml_user, "validated_user" => $user_tervalidasi, "not_validated_user" => $user_blm_divalidasi, "rejected_user"=>$user_ditolak];
        return response()->json(['data' => $data],200);
    }

    // business analytic target
    public function readTarget()
    {
        // $idUser = 1; //admin
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

    public function addTarget(Request $request)
    {
        $idUser = Auth::user()->id;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $jenisCabai = $request->jenis_cabai;
        $check = Target::Where([
            ['user_id',$idUser],
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

    public function deleteTarget($id)
    {
        $target = Target::find($id);
        $target->delete();
        return 204;
    }

    public function getTarget()
    {
        $idUser = Auth::user()->id; //mengambil id dari user yang sedang login
        // $idUser = 1; //admin
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

}
