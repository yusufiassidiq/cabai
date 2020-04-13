<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Target;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function readTarget()
    {
        $idUser = Auth::user()->id;
        $target = Target::where('user_id',$idUser)->get();
        return response()->json([
            'status' => 'success',
            'data' => $target->toArray(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTarget(Request $request)
    {
        $this->validate($request, [
            'tahun' => 'required|integer|min:2020',
            'bulan' => 'required',
            'jenis_cabai' => 'required',
            'jumlah_cabai' => 'required|integer'
		]);
        $idUser = Auth::user()->id;
        $target = new Target;
        $target->user_id = $idUser;
        $target->tahun = $request->tahun;
        $target->bulan = $request->bulan;
        $target->jenis_cabai = $request->jenis_cabai;
        $target->jumlah_cabai = $request->jumlah_cabai;
        $target->save();
        return response()->json(['status' => 'success'], 200);
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
    public function updateTarget(Request $request, $id)
    {
        $target = Target::find($id);
        $target->update([
            'tahun' => request('tahun'),
            'bulan' => request('bulan'),
            'jenis_cabai' => request('jenis_cabai'),
            'jumlah_cabai' => request('jumlah_cabai'),
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTarget($id)
    {
        $target = Target::find($id);
        $target->delete();
        return 204;
    }
    
}
