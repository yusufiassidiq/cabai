<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Kemitraan;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Transaksi;
use App\Inventaris;
use Carbon\Carbon;

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
        $users = DB::table('users')->where('status', '=', '0')->paginate(6);
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function validateduser(){
        $users = DB::table('users')->where('status', '=', '1')->where('role', '!=', '1')->paginate(6);
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function getMitraProdusen(){
        $userId = Auth::user()->id;
        $mitra = Kemitraan::whereHas('user1')->get();
        $j=0;
        $listuser[]=0;
        foreach($mitra as $i){
            $user1 = $i->user1_id;
            $user2 = $i->user2_id;
            if($user1 == $userId) {
                $listuser[$j] = $user2;
            }
            else if ($user2 == $userId){
                $listuser[$j] = $user1;
            }
            $j++;
        }
        // return $listuser;
        $listProdusen = User::where('role',2)->where('status',1)->whereNotIn('id',$listuser)->paginate(6);
        foreach ($listProdusen as $i){
            $i->lokasiKabupaten = $i->lokasi()->first()->kabupaten;
            $i->lokasiKecamatan = $i->lokasi()->first()->kecamatan;
            $i->lokasiKelurahan = $i->lokasi()->first()->kelurahan;
        }
        return response()->json([
                'status' => 'success',
                'data' => $listProdusen->toArray()
            ], 200);
    }

    public function getMitraPengepul(){
        $userId = Auth::user()->id;
        $mitra = Kemitraan::whereHas('user1')->get();
        $j=0;
        $listuser[]=0;
        foreach($mitra as $i){
            $user1 = $i->user1_id;
            $user2 = $i->user2_id;
            if($user1 == $userId) {
                $listuser[$j] = $user2;
            }
            else if ($user2 == $userId){
                $listuser[$j] = $user1;
            }
            $j++;
        }
        $listPengepul = User::where('role',3)->where('status',1)->whereNotIn('id',$listuser)->paginate(6);
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
        $userId = Auth::user()->id;
        $mitra = Kemitraan::whereHas('user1')->get();
        $j=0;
        $listuser[]=0;
        foreach($mitra as $i){
            $user1 = $i->user1_id;
            $user2 = $i->user2_id;
            if($user1 == $userId) {
                $listuser[$j] = $user2;
            }
            else if ($user2 == $userId){
                $listuser[$j] = $user1;
            }
            $j++;
        }
        $listGrosir = User::where('role',4)->where('status',1)->whereNotIn('id',$listuser)->paginate(6);
        foreach ($listGrosir as $i){
            $i->lokasiKabupaten = $i->lokasi()->first()->kabupaten;
            $i->lokasiKecamatan = $i->lokasi()->first()->kecamatan;
            $i->lokasiKelurahan = $i->lokasi()->first()->kelurahan;
        }
        return response()->json([
                'status' => 'success',
                'data' => $listGrosir->toArray()
            ], 200);
    }

    public function getMitraPengecer(){
        $userId = Auth::user()->id;
        $mitra = Kemitraan::whereHas('user1')->get();
        $j=0;
        $listuser[]=0;
        foreach($mitra as $i){
            $user1 = $i->user1_id;
            $user2 = $i->user2_id;
            if($user1 == $userId) {
                $listuser[$j] = $user2;
            }
            else if ($user2 == $userId){
                $listuser[$j] = $user1;
            }
            $j++;
        }
        $listPengecer = User::where('role',5)->where('status',1)->whereNotIn('id',$listuser)->paginate(6);
        foreach ($listPengecer as $i){
            $i->lokasiKabupaten = $i->lokasi()->first()->kabupaten;
            $i->lokasiKecamatan = $i->lokasi()->first()->kecamatan;
            $i->lokasiKelurahan = $i->lokasi()->first()->kelurahan;
        }
        return response()->json([
                'status' => 'success',
                'data' => $listPengecer->toArray()
            ], 200); 
    }

    public function getMitraKonsumen(){
        $userId = Auth::user()->id;
        $mitra = Kemitraan::whereHas('user1')->get();
        $j=0;
        $listuser[]=0;
        foreach($mitra as $i){
            $user1 = $i->user1_id;
            $user2 = $i->user2_id;
            if($user1 == $userId) {
                $listuser[$j] = $user2;
            }
            else if ($user2 == $userId){
                $listuser[$j] = $user1;
            }
            $j++;
        }
        $listKonsumen = User::where('role',6)->where('status',1)->whereNotIn('id',$listuser)->paginate(6);
        foreach ($listKonsumen as $i){
            $i->lokasiKabupaten = $i->lokasi()->first()->kabupaten;
            $i->lokasiKecamatan = $i->lokasi()->first()->kecamatan;
            $i->lokasiKelurahan = $i->lokasi()->first()->kelurahan;
        }
        return response()->json([
                'status' => 'success',
                'data' => $listKonsumen->toArray()
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
        $checkMitra = Kemitraan::where('user1_id',$idUser1)->where('user2_id',$idUser2)->where('status',1)->get();
        if($checkMitra->isNotEmpty()){
            return response()->json([
                'status' => 'failed',
                'message' => 'Pengguna ini telah bermitra dengan anda'                                    
                ], 422);
        }
        $checkIsEmpty = Kemitraan::where('user1_id',$idUser1)->where('user2_id',$idUser2)->where('status',0)->get();
        // return $checkIsEmpty;
        if ($checkIsEmpty->isNotEmpty()){
            return response()->json([
                'status' => 'failed',
                'message' => 'Pengguna ini atau Anda telah mengajukan permintaan kemitraan sebelumnya'                                    
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

        if($userId != $user1){
            if($userId != $user2){
                return response()->json(['status' => 'error'], 422);
            }
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
        })->where('status',0)->where('action_user',$userId)->paginate(6);
        $j=0;
        
        foreach ($listPengajuanMitra as $i){
            if($listPengajuanMitra[$j]->flag == 0){
                $i->nama = $i->user2()->first()->name;
                $i->role = $i->user2()->first()->role;
                $i->lokasi = $i->user2()->first()->lokasi()->first(['kabupaten','kecamatan','kelurahan']);                
            }else{
                $i->nama = $i->user1()->first()->name;
                $i->role = $i->user1()->first()->role;
                $i->lokasi = $i->user1()->first()->lokasi()->first(['kabupaten','kecamatan','kelurahan']);
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
        })->where('status',0)->whereNotIn('action_user',[$userId])->paginate(6);
        $j=0;
        foreach ($listPermintaanMitra as $i){
            if($listPermintaanMitra[$j]->flag == 0){
                $i->nama = $i->user1()->first()->name;
                $i->role = $i->user1()->first()->role;
                $i->lokasi = $i->user1()->first()->lokasi()->first(['kabupaten','kecamatan','kelurahan']); 
            }else{
                $i->nama = $i->user2()->first()->name;
                $i->role = $i->user2()->first()->role;
                $i->lokasi = $i->user2()->first()->lokasi()->first(['kabupaten','kecamatan','kelurahan']); 
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
        })->where('status',1)->paginate(6);
        
        $j=0;
        foreach($listMitraSaya as $i){
            $user1 = $i->user1_id;
            $user2 = $i->user2_id;
            // dd($user1);
            if($userId == $user1){
                $i->mitra = $user2;
                $i->nama = $i->user2()->first()->name;
                $i->role = $i->user2()->first()->role;
                $i->lokasi = $i->user2()->first()->lokasi()->first(['kabupaten','kecamatan','kelurahan']);
               
            }else if ($userId == $user2){
                $i->mitra = $user1;
                $i->nama = $i->user1()->first()->name;
                $i->role = $i->user1()->first()->role;
                $i->lokasi = $i->user1()->first()->lokasi()->first(['kabupaten','kecamatan','kelurahan']); 
               
            }
            $j++;
        }
        // dd($listMitraSaya);
        return response()->json([
            'status' => 'success', 
            'data' => $listMitraSaya->toArray()
        ], 200);
    }

    public function listMitraPemasok(){
        $userId = Auth::user()->id;
        $roleUser = Auth::user()->role;
        $listMitraSaya = Kemitraan::orWhere(function($query)use($userId){
            $query->orWhere('user2_id',$userId)->orWhere('user1_id',$userId);
        })->where('status',1)->get();
        $daftarMitraId[] = null;
        $j = 0;
        foreach($listMitraSaya as $i){
            $user1 = $i->user1_id;
            $user2 = $i->user2_id;
            // dd($user1);
            if($userId == $user1){
                $daftarMitraId[$j] = $user2;
                $j++;
            }else if ($userId == $user2){
                $daftarMitraId[$j] = $user1;
                $j++;          
            }
        }
        // dd($daftarMitraId);
        
        $daftarMitra = collect([]);
            foreach($daftarMitraId as $k){
                $akun = User::find($k);
                if($akun){
                    if($akun->role < $roleUser){
                       $daftarMitra->push($akun); 
                    }
                }
            }
        // dd($daftarMitra);
        return response()->json([
            'status' => 'success', 
            'data' => $daftarMitra->toArray()
        ], 200);
    }

    public function hapusMitra($id){
        $kemitraan = Kemitraan::find($id);
        $kemitraan->delete();
        return response()->json([
            'status' => 204
        ]);
    }

    public function addPermintaanSaya(Request $request){
        $v = Validator::make($request->all(), [
            'jenis_cabai'     => 'required|string|max:255',
            'jumlah_cabai'      => 'required|integer',
            'tanggal_diterima'    => 'required|date',
        ]);
        
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = Auth::user();
        $tglditerima = $request->tanggal_diterima;
        $parsed_date_tglditerima = Carbon::parse($tglditerima)->toDateTimeString();
        $transaksi = new Transaksi;
        $transaksi->jenis_cabai = $request->jenis_cabai;
        $transaksi->jumlah_cabai = $request->jumlah_cabai;
        $transaksi->tanggal_diterima = $parsed_date_tglditerima;
        $transaksi->status_permintaan = 0;
        $transaksi->pemasok_id = $request->pemasok_id;
        $transaksi->user()->associate($user);
        $transaksi->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function getPermintaanMasuk(){
        $userId = Auth::user()->id;
        $transaksi = Transaksi::where([
            ['pemasok_id','=',$userId],
            ['status_pemesanan', '=', null],
        ])->orWhere([
            ['pemasok_id','=',$userId],
            ['status_pemesanan', '=', 0],
        ])
        ->orderBy('updated_at','DESC')->paginate(6);
        foreach($transaksi as $i){
            $i->nama = $i->user()->first()->name;
        }
        // return $transaksi;
        return response()->json([
            'status' => 'success', 
            'data' => $transaksi->toArray()
        ], 200);
    }
    public function getRiwayatPermintaanMasuk(){
        $userId = Auth::user()->id;
        $transaksi = Transaksi::where([
            ['pemasok_id','=',$userId],
            ['status_pemesanan', '=', 1],
        ])
        ->orderBy('tanggal_pengiriman','DESC')->paginate(6);
        foreach($transaksi as $i){
            $i->nama = $i->user()->first()->name;
        }
        return response()->json([
            'status' => 'success', 
            'data' => $transaksi->toArray()
        ], 200);
    }
    public function getPermintaanSaya(){
        $userId = Auth::user()->id;
        $transaksi = Transaksi::where([
            ['user_id','=',$userId],
            ['status_pemesanan', '=', null],
        ])->orWhere([
            ['user_id','=',$userId],
            ['status_pemesanan', '=', 0],
        ])
        ->orderBy('updated_at','DESC')->paginate(6);

        $j=0;
        foreach($transaksi as $i){
            $id_pemasok = $transaksi[$j]->pemasok_id;
            $user = User::find($id_pemasok);
            $lokasi = $user->lokasi()->first(['kabupaten','kecamatan','kelurahan']);
            $i->lokasi = $lokasi;
            $nama_pemasok = $user->name;
            $role_pemasok = $user->role;
            $i->nama = $nama_pemasok;
            $i->role = $role_pemasok;
            // $
            $j++;
        }
        return response()->json([
            'status' => 'success', 
            'data' => $transaksi->toArray()
        ], 200);
    }
    public function getRiwayatPermintaanSaya(){
        $userId = Auth::user()->id;
        $transaksi = Transaksi::where([
            ['user_id','=',$userId],
            ['status_pemesanan', '=', 1],
        ])
        ->orderBy('tanggal_diterima','DESC')->paginate(6);

        $j=0;
        foreach($transaksi as $i){
            $id_pemasok = $transaksi[$j]->pemasok_id;
            $user = User::find($id_pemasok);
            $lokasi = $user->lokasi()->first(['kabupaten','kecamatan','kelurahan']);
            $i->lokasi = $lokasi;
            $nama_pemasok = $user->name;
            $role_pemasok = $user->role;
            $i->nama = $nama_pemasok;
            $i->role = $role_pemasok;
            // $
            $j++;
        }
        return response()->json([
            'status' => 'success', 
            'data' => $transaksi->toArray()
        ], 200);
    }
    public function tolakPermintaanPembeli(Request $request, $id){
        $transaksi = Transaksi::find($id);
        // dd($transaksi);
        $transaksi->update([
            'status_permintaan' => 2,
            'keterangan' => $request->keterangan,
        ]);
        return response()->json(['status' => 'success'], 200);
    }
    public function hapusPermintaanPesanan($id){
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return response()->json([
            'status'=>'success'
        ],204);
    }
    public function requestUlangPermintaanSaya(Request $request, $id){
        $transaksi = Transaksi::find($id);
        $tgl_diterima = $request->tanggal_diterima;
        $parsed_date = Carbon::parse($tgl_diterima)->toDateTimeString();
        $transaksi->update([
            'status_permintaan' => 0,
            'tanggal_diterima' => $parsed_date,
            'jumlah_cabai' => $request->jumlah_cabai,
            'keterangan' => $request->keterangan,
        ]);
        return response()->json(['status' => 'success'], 200);
    }
    public function terimaPermintaanMasuk(Request $request, $id){
        $transaksi = Transaksi::find($id);
        $tgl_pengiriman = $request->tanggal_pengiriman;
        $parsed_date = Carbon::parse($tgl_pengiriman)->toDateTimeString();
        $transaksi->update([
            'status_permintaan' => 1,
            'tanggal_pengiriman' => $parsed_date,
            'harga' => $request->harga,
        ]);
        return response()->json(['status' => 'success'], 200);
    }
    public function tolakPenawaranPemasok(Request $request, $id){
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'status_permintaan' =>4,
            'keterangan' => $request->keterangan,
        ]);
        return response()->json(['status' => 'success'], 200);
    }
    public function terimaPenawaranPemasok($id){
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'status_permintaan' => 3,
            'status_pengiriman' => 0,
        ]);
        return response()->json(['status' => 'success'], 200);
    }
    public function getInventaris(){
        $userId = Auth::user()->id;
        $inventaris = Inventaris::where('user_id',$userId)->get();
        return response()->json([
            'status' => 'success', 
            'data' => $inventaris->toArray(),
            'role' =>$userId
        ], 200);
    }
    public function addInventaris(Request $request){
        $userId = Auth::user()->id;
        $jumlah_cabai = $request->jumlah_cabai;
        $jenis_cabai = $request->jenis_cabai;
        $inventaris = Inventaris::where('jenis_cabai',$jenis_cabai)->where('user_id',$userId)->get();
        foreach ($inventaris as $i ) {
            $jumlah_cabai_sementara = $i->jumlah_cabai;
            $i->update([
                'jumlah_cabai' => $jumlah_cabai_sementara + $jumlah_cabai
            ]);
        }
        return response()->json(['status' => 'success'], 200);
    }
    public function stokKeluar(Request $request, $idTransaksi){
        $userId = Auth::user()->id;
        $jumlah_cabai = $request->jumlah_cabai;
        $jenis_cabai = $request->jenis_cabai;
        $inventaris = Inventaris::where('jenis_cabai',$jenis_cabai)->where('user_id',$userId)->get();
        
        foreach ($inventaris as $i ) {
            $jumlah_cabai_sementara = $i->jumlah_cabai;
            $hargaTemp = $i->harga;
            if ($hargaTemp == 0){
                $i->update([
                    'jumlah_cabai' => $jumlah_cabai_sementara - $jumlah_cabai,
                    'harga' =>  $request->harga,
                ]);
            }
            else {
                $i->update([
                    'jumlah_cabai' => $jumlah_cabai_sementara - $jumlah_cabai,
                    'harga' => ($hargaTemp + $request->harga)/2,
                ]);
                $hargaTemp = 0;  
            }
        }
        $transaksi = Transaksi::find($idTransaksi);
        $transaksi->update([
            'status_pengiriman' => 1,
            'status_pemesanan' => 0,
        ]);
        return response()->json(['status' => 'success'], 200);
    }
    public function stokMasuk(Request $request, $idTransaksi){
        $userId = Auth::user()->id;
        $jumlah_cabai = $request->jumlah_cabai;
        $jenis_cabai = $request->jenis_cabai;
        $inventaris = Inventaris::where('jenis_cabai',$jenis_cabai)->where('user_id',$userId)->get();
        foreach ($inventaris as $i ) {
            $jumlah_cabai_sementara = $i->jumlah_cabai;
            $i->update([
                'jumlah_cabai' => $jumlah_cabai_sementara + $jumlah_cabai,
            ]);
        }
        $transaksi = Transaksi::find($idTransaksi);
        $transaksi->update([
            'status_pemesanan' => 1,
        ]);
        return response()->json(['status' => 'success'], 200);
    }
}
