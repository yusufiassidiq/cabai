<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PraProduksi;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;

class ProdusenController extends Controller
{
    public function addLahan(Request $request){
        $v = Validator::make($request->all(), [
            'kode_lahan'      => 'required|string|max:255',
            'jenis_cabai'     => 'required|string|max:255',
            'luas_lahan'      => 'required|integer|max:255',
            'tanggal_tanam'    => 'required|date',
        ]);
        
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }    
        $idUser = Auth::user()->id;
        $tgltnm = $request->tanggal_tanam;
        $parsed_date = Carbon::parse($tgltnm)->toDateTimeString();

        $lahan = new PraProduksi;
        $lahan->kode_lahan = $request->kode_lahan;
        $lahan->jenis_cabai = $request->jenis_cabai;
        $lahan->tanggal_tanam = $parsed_date;
        $lahan->luas_lahan = $request->luas_lahan;
        $lahan->user_id = $idUser;
        $lahan->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function readLahan(){
        $praProduksi = PraProduksi::get();
        // dd($praProduksi);
        return response()->json([
            'status' => 'success',
            'data' => $praProduksi->toArray(),
        ]);
    }
}
