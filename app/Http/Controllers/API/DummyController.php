<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

// Controller ini merupakan controller percobaan buat frontend, nantinya
// kontroller ini akan dihapus

class DummyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return User::latest()->paginate(10) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'role'      => 'required',
            'status'    => 'required',
            'password'  => 'required|string|min:6'
        ]);

        return User::create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'role'      => $request['role'],
            'status'    => $request['status'],
            'password'  => Hash::make($request['password'])
        ]);
        // return ['message' => 'i have data'];
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request,[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role'      => 'required',
            'status'    => 'required',
            'password'  => 'sometimes|min:6'
        ]);
        $user -> update($request->all());
        // return ['message' => 'update data'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // delete the user
        $user->delete();
        return ['message' => 'User Deleted'];
    }
}
