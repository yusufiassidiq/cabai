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
