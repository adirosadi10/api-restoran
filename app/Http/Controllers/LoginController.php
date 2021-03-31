<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class LoginController extends Controller
{
    public function register(Request $request){
        $this->validate($request,[
            'email' => 'required|unique:users',
            'password' => 'required',
            'relasi' => 'required',
            
        ]);
        $data =[
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'level'=>'pelanggan',
            'api_token'=>'123456',
            'status'=>'1',
            'relasi'=>$request->input('email'),
        ];
        User::create($data);
        return response()->json($data);
    }
    public function login(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');

        $User = User::where('email',$email)->first();
        if($User->password === $password){
            $token = Str::random(40);

            $User->update([
                'api_token' => $token
            ]);

            return response()->json([
                'pesan' => 'login berhasil',
                'token' => $token,
                'data' => $User
            ]);
        }else {
            return response()->json([
                'pesan' => 'login gagal',
                // 'token' => $token,
                'data' => ''
            ]);
            
        }
    }
}
