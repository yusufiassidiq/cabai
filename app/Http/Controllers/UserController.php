<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();   
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }    
    
    public function show(Request $request, $id)
    {
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

    public function requesteduser()
    {
        $users = DB::table('users')->where('status', '=', '0')->get();
        
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function validateduser()
    {
        $users = DB::table('users')->where('status', '=', '1')->get();
        
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }
}
