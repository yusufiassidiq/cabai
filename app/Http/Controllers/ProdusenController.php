<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PraProduksi;
use App\PengeluaranProduksi;
use App\Kemitraan;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
use DB;
use App\Panen;
use App\Inventaris;

class ProdusenController extends Controller
{
    public function addLahan(Request $request){
        $v = Validator::make($request->all(), [
            'kode_lahan'      => 'required|string|max:255',
            'jenis_cabai'     => 'required|string|max:255',
            'luas_lahan'      => 'required|integer',
            'tanggal_tanam'    => 'required|date',
        ]);
        
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }    
        // $idUser = Auth::user()->id;
        $user = Auth::user();
        $tgltnm = $request->tanggal_tanam;
        $parsed_date = Carbon::parse($tgltnm)->toDateTimeString();
        // dd($parsed_date);
        $lahan = new PraProduksi;
        $lahan->kode_lahan = $request->kode_lahan;
        $lahan->jenis_cabai = $request->jenis_cabai;
        $lahan->tanggal_tanam = $parsed_date;
        $lahan->luas_lahan = $request->luas_lahan;
        // $lahan->user_id = $idUser;
        $lahan->user()->associate($user);
        $lahan->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function readLahan(){
        $userId = Auth::user()->id;
        $praProduksi = PraProduksi::where('user_id',$userId)->paginate(6);
        foreach($praProduksi as $i){
            $i->pengeluaran = $i->pengeluaranProduksi()->sum('jumlah_pengeluaran');
        }
        return response()->json([
            'status' => 'success',
            'data' => $praProduksi->toArray(),
        ]);
    }
    public function readAllLahan(){
        $userId = Auth::user()->id;
        $praProduksi = PraProduksi::where('user_id',$userId)->get();
        foreach($praProduksi as $i){
            $i->pengeluaran = $i->pengeluaranProduksi()->sum('jumlah_pengeluaran');
        }
        return response()->json([
            'status' => 'success',
            'data' => $praProduksi->toArray(),
        ]);
    }
    public function updateLahan(Request $request, $id){
        $praProduksi = PraProduksi::findOrFail($id);
        $tgltnm = $request->tanggal_tanam;
        $parsed_date = Carbon::parse($tgltnm)->toDateTimeString();
        $praProduksi->update([
            'kode_lahan' => request('kode_lahan'),
            'jenis_cabai' => request('jenis_cabai'),
            'luas_lahan' => request('luas_lahan'),
            'tanggal_tanam' => $parsed_date,
        ]);
        return response()->json(['status' => 'success'], 200);
    }
    public function deleteLahan($id){
        $praProduksi = PraProduksi::findOrFail($id);
        $praProduksi->pengeluaranProduksi()->delete();
        $praProduksi->delete();
        return 204;
    }
    public function addPengeluaran(Request $request){
        $v = Validator::make($request->all(), [
            'nama_pengeluaran'      => 'required|string|max:255',
            'jumlah_pengeluaran'    => 'required|integer',
            // 'rincian'               => 'required|string|max:255',
        ]);
        
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }    
        $userId = Auth::user()->id;
        $pengeluaran = new PengeluaranProduksi;
        $pengeluaran->pra_produksi_id = $request->pra_produksi_id;
        $pengeluaran->nama_pengeluaran = $request->nama_pengeluaran;
        $pengeluaran->jumlah_pengeluaran = $request->jumlah_pengeluaran;
        $pengeluaran->rincian = $request->rincian;
        $pengeluaran->user_id = $userId;
        $pengeluaran->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function readPengeluaran(){  
        $userId = Auth::user()->id;
        $pengeluaran= PengeluaranProduksi::where('user_id',$userId)->paginate(6);
        foreach($pengeluaran as $i){

            $i->kodeLahan = $i->praProduksi()->first()->kode_lahan;
        }
        return response()->json([
            'status' => 'success',
            'data' => $pengeluaran->toArray(),
        ]);
    }
    public function updatePengeluaran(Request $request, $id){
        $pengeluaran = PengeluaranProduksi::findOrFail($id);
        $pengeluaran->update([
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'rincian' => $request->rincian
        ]);
    }
    public function deletePengeluaran($id){
        $pengeluaran = PengeluaranProduksi::findOrFail($id);
        $pengeluaran->delete();
        return 204;
    }
    public function addPanen(Request $request){
        $userId = Auth::user()->id;
        $panen = new Panen;
        $panen->pra_produksi_id = $request->pra_produksi_id;
        $panen->jumlah_panen = $request->jumlah_cabai;
        $parsed_date = Carbon::parse($request->tanggal_panen)->toDateTimeString();
        $panen->tanggal_panen = $parsed_date;
        $panen->user_id = $userId;
        $panen->save();
        $jumlah_cabai = $request->jumlah_cabai;
        $praProduksi = PraProduksi::find($request->pra_produksi_id);
        $jenis_cabai = $praProduksi->jenis_cabai;
        $inventaris = Inventaris::where('jenis_cabai',$jenis_cabai)->where('user_id',$userId)->get();
        foreach ($inventaris as $i ) {
            $jumlah_cabai_sementara = $i->jumlah_cabai;
            $i->update([
                'jumlah_cabai' => $jumlah_cabai_sementara + $jumlah_cabai,
            ]);
        }
        return response()->json(['status' => 'success'], 200);
    }
    public function getPanen(){
        $idUser = Auth::user()->id;
        //bisa pake ini
        $panens = Panen::whereHas("praProduksi", function($qPraProduksi) use ($idUser){
            $qPraProduksi->whereHas("user", function($qUser) use($idUser){
                $qUser->where("id", $idUser);
            });
        })->paginate(6);
        //atau ini yg lebih sederhana
        // $praProduksi_id = PraProduksi::where("user_id", $idUser)->pluck("id");
        // $panens = Panen::whereIn("pra_produksi_id", $praProduksi_id)->get();
        foreach($panens as $panen){
            $panen->kode_lahan = $panen->praProduksi()->first()->kode_lahan;
            $panen->jenis_cabai = $panen->praProduksi()->first()->jenis_cabai;
        }
        // dd($panens);
        return response()->json([
            'status' => 'success',
            'data' => $panens->toArray(),
        ]);
    }
    public function updatePanen($id, Request $request){
        $userId = Auth::id();
        $panen = Panen::findOrFail($id);
        $perubahan_jumlah_panen = $request->jumlah_cabai - $panen->jumlah_panen;
        $panen->update([
            'jumlah_panen' => $request->jumlah_cabai,
            'tanggal_panen' => $request->tanggal_panen,
        ]);
        $praProduksi = PraProduksi::find($request->pra_produksi_id);
        $jenis_cabai = $praProduksi->jenis_cabai;
        $inventaris = Inventaris::where('jenis_cabai',$jenis_cabai)->where('user_id',$userId)->get();
        foreach ($inventaris as $i ) {
            $jumlah_cabai_sementara = $i->jumlah_cabai;
            $i->update([
                'jumlah_cabai' => $jumlah_cabai_sementara  + $perubahan_jumlah_panen,
            ]);
        }
        return response()->json(['status' => 'success'], 200);
    }
    public function deletePanen($id){
        $userId = Auth::id();
        $panen = Panen::findOrFail($id);
        $panen_sebelumnya = $panen->jumlah_panen;
        $jenis_cabai = $panen->praProduksi->jenis_cabai;
        $inventaris = Inventaris::where('jenis_cabai',$jenis_cabai)->where('user_id',$userId)->get();
        foreach ($inventaris as $i ) {
            $jumlah_cabai_sementara = $i->jumlah_cabai;
            $i->update([
                'jumlah_cabai' => $jumlah_cabai_sementara  - $panen_sebelumnya,
            ]);
        }
        $panen->delete();
        return 204;
    }
}
