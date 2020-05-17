<?php

namespace App\Http\Controllers;

use App\User;
use App\Lokasi;
use App\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
            'role' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'fotosk' => 'required|image64:jpeg,png,jpg',
        ]);        
        
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }        
        $fotosk = $request->get('fotosk');
        if(isset($fotosk)){
            // $nama_gambar = Carbon::now()."_".$fotosk->getClientOriginalName();
            // // isi dengan nama folder tempat kemana gambar diupload
		    // $tujuan_upload = 'uploads/fotosk';
            // $fotosk->move($tujuan_upload,$nama_gambar);
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($fotosk, 0, strpos($fotosk, ';')))[1])[1];
            \Image::make($request->get('fotosk'))->save(public_path('images/').$fileName);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->fotosk = $fileName;
        $user->save();        
        $lokasi = new Lokasi([
            'user_id'=>$user->id
        ]);
        $lokasi->user()->associate($user);
        $lokasi->kabupaten = $request->kabupaten;
        $lokasi->kecamatan = $request->kecamatan;
        $lokasi->kelurahan = $request->kelurahan;
        $lokasi->save();
        $jenis_cabai=array("Cabai besar","Cabai rawit","Cabai keriting");
        foreach ($jenis_cabai as $i){
            $inventori = new Inventaris([
                'jenis_cabai'=>$i,
                'jumlah_cabai'=>0,
                'harga'=>0
            ]);
            $inventori->user()->associate($user);
            $inventori->save();
        }
        return response()->json(['status' => 'success'], 200);
    }    
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');        
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }        
        return response()->json(['error' => 'login_error'], 401);
    }    
    
    public function logout()
    {
        $this->guard()->logout();        
    
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }    
    
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);        
        
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }    
    
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }        
        
        return response()->json(['error' => 'refresh_token_error'], 401);
    }    
    
    private function guard()
    {
        return Auth::guard();
    }
}
