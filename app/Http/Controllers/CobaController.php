<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class CobaController extends Controller
{
    public function index()
    {
       return User::latest()->paginate(10) ;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'role'      => 'required|string|max:255',
            'status'    => 'required|string|max:255',
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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // delete the user
        $user->delete();
        return ['message' => 'User Deleted'];
    }
}
