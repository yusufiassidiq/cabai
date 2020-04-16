<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PraProduksi;
use App\PengeluaranProduksi;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
use DB;

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
        $praProduksi = PraProduksi::get();
        // $praProduksi = PraProduksi::where('id',1)->get();
        // $asd = $praProduksi[0]->pengeluaranProduksi->first();
        // dd($asd);
        return response()->json([
            'status' => 'success',
            'data' => $praProduksi->toArray(),
        ]);
    }
    public function updateLahan(Request $request, $id){
        $praProduksi = PraProduksi::find($id);
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
        $praProduksi = PraProduksi::find($id);
        $praProduksi->pengeluaranProduksi()->delete();
        $praProduksi->delete();
        return 204;
    }
    public function addPengeluaran(Request $request){
        $v = Validator::make($request->all(), [
            'nama_pengeluaran'      => 'required|string|max:255',
            'jumlah_pengeluaran'    => 'required|integer',
            'rincian'               => 'required|string|max:255',
        ]);
        
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }    
        $pengeluaran = new PengeluaranProduksi;
        $pengeluaran->pra_produksi_id = $request->pra_produksi_id;
        $pengeluaran->nama_pengeluaran = $request->nama_pengeluaran;
        $pengeluaran->jumlah_pengeluaran = $request->jumlah_pengeluaran;
        $pengeluaran->rincian = $request->rincian;
        $pengeluaran->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function readPengeluaran(){
        $pengeluaran= PengeluaranProduksi::all();
        foreach($pengeluaran as $i){
            $i->kodeLahan = $i->praProduksi()->first()->kode_lahan;
        }
        return response()->json([
            'status' => 'success',
            'data' => $pengeluaran->toArray(),
        ]);
    }
    public function updatePengeluaran(Request $request, $id){
        $pengeluaran = PengeluaranProduksi::find($id);
        $pengeluaran->update([
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'rincian' => $request->rincian
        ]);
    }
    public function deletePengeluaran($id){
        $pengeluaran = PengeluaranProduksi::find($id);
        $pengeluaran->delete();
        return 204;
    }
}
