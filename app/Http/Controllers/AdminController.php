<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function delete($id)
    {
        $user = User::find($id);
        $user->lokasi()->delete();
        $user->praProduksi()->pengeluaranProduksi()->delete();
        $user->praProduksi()->delete();
        $user->kemitraan()->delete();
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
    public function dashboardAdmin()
    {
        $jml_user = User::count();
        $user_tervalidasi = User::where('status', 1)->count();
        $user_blm_divalidasi = $jml_user - $user_tervalidasi;

        $data = ["total_user" => $jml_user, "validated_user" => $user_tervalidasi, "not_validated_user" => $user_blm_divalidasi];
        return response()->json(['data' => $data],200);
    }

}
