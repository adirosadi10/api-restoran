<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    public function index (){
        $data = User::where('level','<>','pelanggan')->get();
        return response()->json($data);
    }
    public function register(Request $request){
        $this->validate($request,[
            'email' => 'required|unique:users',
            'password' => 'required',
            'relasi' => 'required',
            
        ]);
        $data =[
            'email'=>$request->input('email'),
            'password'=> Hash::make( $request->input('password')),
            'level'=>$request->input('level'),
            'api_token'=>'123456',
            'status'=>'1',
            'relasi'=>$request->input('relasi'),
        ];
        $user = User::create($data);
        if ($user) {
            return response()->json([
                'pesan' => 'Data berhasil disimpan'
            ]);
        }
    }
    public function login(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');

        $User = User::where('email',$email)->first();
        if (isset($User) ){

            if($User->status === 1){
    
                if(Hash::check($password, $User->password )){
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
            }else {
                return response()->json([
                    'pesan' => 'login gagal',
                    // 'token' => $token,
                    'data' => ''
                ]);
                    
            }
        }else {
            return response()->json([
                'pesan' => 'login gagal',
                // 'token' => $token,
                'data' => ''
            ]);
                
        }
    }
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->update($request->all());
        if ($user) {
            return response()->json([
                'pesan' => "Data berhasil update"
            ]);
        }
    }
}
