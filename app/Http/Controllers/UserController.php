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
        $users = DB::table('users')->where('status', '=', '1')->get();
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
        foreach ($listPengepul as $i){
            $i->lokasiKabupaten = $i->lokasi()->first()->kabupaten;
            $i->lokasiKecamatan = $i->lokasi()->first()->kecamatan;
            $i->lokasiKelurahan = $i->lokasi()->first()->kelurahan;
        }
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
        
        //cek id user 1 harus lebih kecil
        if($idUser2 < $idUser1) {
            $temp = $idUser2;
            $idUser2 = $idUser1;
            $idUser1 = $temp;
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
        $kemitraan->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function terimaMitra($id){
        if($id == Auth::user()->id){
            return response()->json(['status' => 'failed'], 409);
        }
        $idUser1 = Auth::user()->id;
        $idUser2 = $id;
        $action_user = Auth::user()->id;
        
        //cek id user 1 harus lebih kecil
        if($idUser2 < $idUser1) {
            $temp = $idUser2;
            $idUser2 = $idUser1;
            $idUser1 = $temp;
        }
        
        //cek action user
        $checkActionUser = Kemitraan::where('status',0)->where('user1_id',$idUser1)->where('user2_id',$idUser2)->get();
        if($action_user == $checkActionUser[0]->action_user){
            return response()->json([
                'status' => 'failed',
                'data' => 'Anda tidak bisa menerima permintaan kemitraan yang anda buat sendiri'
            ]);
        }
        $kemitraan = new Kemitraan;
        $kemitraan->status = 1; //diterima
        $kemitraan->action_user = $action_user;
        $kemitraan->user1_id = $idUser1;
        $kemitraan->user2_id = $idUser2;
        $kemitraan->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function tolakMitra($id){
        if($id == Auth::user()->id){
            return response()->json(['status' => 'failed'], 409);
        }
        $idUser1 = Auth::user()->id;
        $idUser2 = $id;
        $action_user = Auth::user()->id;
        
        //cek id user 1 harus lebih kecil
        if($idUser2 < $idUser1) {
            $temp = $idUser2;
            $idUser2 = $idUser1;
            $idUser1 = $temp;
        }

        //cek action user
        $checkActionUser = Kemitraan::where('status',0)->where('user1_id',$idUser1)->where('user2_id',$idUser2)->get();
        if($action_user == $checkActionUser[0]->action_user){
            return response()->json([
                'status' => 'failed',
                'data' => 'Anda tidak bisa menolak permintaan kemitraan yang anda buat sendiri'
            ]);
        }
        $kemitraan = new Kemitraan;
        $kemitraan->status = 2; //ditolak
        $kemitraan->action_user = $action_user;
        $kemitraan->user1_id = $idUser1;
        $kemitraan->user2_id = $idUser2;
        $kemitraan->save();
        return response()->json(['status' => 'success'], 200);
    }

}
