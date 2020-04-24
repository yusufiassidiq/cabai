<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use DB;

class AnalysisHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserCount()
    {
        $year = Carbon::now()->format('Y'); //tahun saat ini
        $role_user = array('Admin','Produsen','Pengepul','Grosir','Pengecer','Konsumen');
        $jml_user = User::count() - 1; //-1 admin
        
        for($i=0; $i<count($role_user); $i++){
            $data_user[$i]= User::where('role', $i+1) -> where('status',1) -> count();;
        }
        // $user_tervalidasi = User::where('status', 1)->count() - 1;// -1 admin
        // $user_blm_divalidasi = User::where('status',0)->count();
        // $user_ditolak = User::where('status',2)->count();

        // $data = ["total_user" => $jml_user, "user_1" => $user_1, "user_2" => $user_2, "user_3" => $user_3, "user_4" => $user_4, "user_5" => $user_5, "user_6" => $user_6];
        // return response()->json(['data' => $data],200);

        return response()->json([
            'role_user' => $role_user,
            'year'  => $year,
            'total_user' => $jml_user, 
            'user' => $data_user,
        ]);
    }
}
