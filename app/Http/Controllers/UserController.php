<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Kemitraan;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = User::all();   
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }    

    public function show(Request $request, $id){
        $user = User::find($id);        
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }
    // public function seeToken(){
    //     $token = JWTAuth::getToken();
    //     $isiToken = JWTAuth::getPayload($token)->toArray();
    //     return $isiToken;
    // }

    public function requesteduser(){
        $users = DB::table('users')->where('status', '=', '0')->get();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function validateduser(){
        $users = DB::table('users')->where('status', '=', '1')->where('role', '!=', '1')->get();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function getMitraProdusen(){
        $listProdusen = User::where('role',2)->where('status',1)->get();
        return response()->json([
                'status' => 'success',
                'data' => $listProdusen->toArray()
            ], 200);
    }

    public function getMitraPengepul(){
        $listPengepul = User::where('role',3)->where('status',1)->get();
        // foreach ($listPengepul as $i){
        //     $i->lokasiKabupaten = $i->lokasi()->first()->kabupaten;
        //     $i->lokasiKecamatan = $i->lokasi()->first()->kecamatan;
        //     $i->lokasiKelurahan = $i->lokasi()->first()->kelurahan;
        // }
        return response()->json([
                'status' => 'success',
                'data' => $listPengepul->toArray()
            ], 200);
    }

    public function getMitraGrosir(){
        $listGrosir = User::where('role',4)->where('status',1)->get();
        return response()->json([
                'status' => 'success',
                'data' => $listGrosir->toArray()
            ], 200);
    }

    public function getMitraPengecer(){
        $listPengecer = User::where('role',5)->where('status',1)->get();
        return response()->json([
                'status' => 'success',
                'data' => $listPengecer->toArray()
            ], 200); 
    }

    public function requestMitra($id){
        if($id == Auth::user()->id){
            return response()->json(['status' => 'failed'], 409);
        }
        $idUser1 = Auth::user()->id;
        $idUser2 = $id;
        $action_user = Auth::user()->id;
        $flag = 0;
        //cek id user 1 harus lebih kecil
        if($idUser2 < $idUser1) {
            $temp = $idUser2;
            $idUser2 = $idUser1;
            $idUser1 = $temp;
            $flag = 1;
        }

        $checkIsEmpty = Kemitraan::where('user1_id',$idUser1)->where('user2_id',$idUser2)->where('status',0)->get();
        // return $checkIsEmpty;
        if ($checkIsEmpty->isNotEmpty()){
            return response()->json([
                'status' => 'failed',
                'data' => 'Pengguna ini atau Anda telah mengajukan permintaan kemitraan sebelumnya'                                    
                ], 422);
        }
        $kemitraan = new Kemitraan;
        $kemitraan->status = 0; //pending
        $kemitraan->action_user = $action_user;
        $kemitraan->user1_id = $idUser1;
        $kemitraan->user2_id = $idUser2;
        $kemitraan->flag = $flag;
        $kemitraan->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function terimaMitra($id){
        $kemitraan = Kemitraan::find($id);
        $userId = Auth::user()->id;
        $user1 = $kemitraan->user1_id;
        $user2 = $kemitraan->user2_id;

        if($userId != $user1 || $userId != $user2){
            return response()->json(['status' => 'error'], 422);
        }

        $kemitraan->update([
            'status' => 1,
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    public function tolakMitra($id){
        $kemitraan = Kemitraan::find($id);
        $userId = Auth::user()->id;
        $user1 = $kemitraan->user1_id;
        $user2 = $kemitraan->user2_id;

        if($userId != $user1 || $userId != $user2){
            return response()->json(['status' => 'error'], 422);
        }

        $kemitraan->update([
            'status' => 3,
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    public function listPengajuanMitra(){
        $userId = Auth::user()->id;
        $listPengajuanMitra = Kemitraan::orWhere(function($query)use($userId){
            $query->orWhere('user2_id',$userId)->orWhere('user1_id',$userId);
        })->where('status',0)->where('action_user',$userId)->get();
        $j=0;
        
        foreach ($listPengajuanMitra as $i){
            if($listPengajuanMitra[$j]->flag == 0){
                $i->nama = $i->user2()->first()->name;
                $i->role = $i->user2()->first()->role;
                $i->lokasi = $i->user2()->first()->lokasi()->first();
                // $i->lokasiKecamatan = $i->user2()->first()->lokasi()->first()->kecamatan;
                // $i->lokasiKelurahan = $i->user2()->first()->lokasi()->first()->kelurahan;
                
            }else{
                $i->nama = $i->user1()->first()->name;
                $i->role = $i->user1()->first()->role;
                // $i->lokasiKabupaten = $i->user1()->first()->lokasi()->first()->kabupaten;
                // $i->lokasiKecamatan = $i->user1()->first()->lokasi()->first()->kecamatan;
                // $i->lokasiKelurahan = $i->user1()->first()->lokasi()->first()->kelurahan;
            }
            $j++;
        }
        // dd($listPengajuanMitra);
        return response()->json([
            'status' => 'success',
            'data' => $listPengajuanMitra->toArray()
        ], 200);
    }

    public function listPermintaanMitra(){
        $userId = Auth::user()->id;
        $listPermintaanMitra = Kemitraan::orWhere(function($query)use($userId){
            $query->orWhere('user2_id',$userId)->orWhere('user1_id',$userId);
        })->where('status',0)->whereNotIn('action_user',[$userId])->get();
        $j=0;
        foreach ($listPermintaanMitra as $i){
            if($listPermintaanMitra[$j]->flag == 0){
                $i->nama = $i->user1()->first()->name;
            }else{
                $i->nama = $i->user2()->first()->name;
            }
            $j++;
        }

        return response()->json([
            'status' => 'success',
            'data' => $listPermintaanMitra->toArray()
        ], 200);
    }

    public function listMitraSaya(){
        $userId = Auth::user()->id;
        $listMitraSaya = Kemitraan::orWhere(function($query)use($userId){
            $query->orWhere('user2_id',$userId)->orWhere('user1_id',$userId);
        })->where('status',1)->get();

        return response()->json([
            'status' => 'success',
            'data' => $listMitraSaya->toArray()
        ], 200);
    }

    public function hapusMitra($id)
    {
        $kemitraan = Kemitraan::find($id);
        $kemitraan->delete();
        return response()->json([
            'status' => 204
        ]);
    }

}
