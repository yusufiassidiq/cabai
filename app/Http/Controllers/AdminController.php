<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class AdminController extends Controller
{
    public function delete($id)
    {
        $user = User::find($id);
        $praProduksis = $user->praProduksi->load('pengeluaranProduksi');
        foreach($praProduksis as $i){
            $i->pengeluaranProduksi()->delete();
        }
        $user->lokasi()->delete();
        $user->praProduksi()->delete();
        DB::table('kemitraan')->orWhere(function($query)use($id){
            $query->orWhere('user2_id',$id)->orWhere('user1_id',$id);
        })->delete();
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
        return response()->json(['status' => 'success'], 200);
    }
}
