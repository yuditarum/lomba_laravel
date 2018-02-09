<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;


class UserController extends Controller
{
    function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        // return $email . " " . $password;
        if (auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }else{
            return 'username atau password salah kakak';
        }
    }
    function register(Request $request){
        // dd($request);
        $email = $request->email;
        $name = $request->name;

        if($email == null){
            return 'email diisi bosku';
        }

        $data = User::where('email',$email)->first();
        if($data != null){
            return 'email sudah terdaftar';
        }
        $data = User::where('name',$name)->first();
        if($data != null){
            return 'nama sudah terdaftar';
        }

  
        

        $user= new User();
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $id = $user->$id;
        Auth::loginUsingId($id);

        return redirect('dashboard');
        
    }
    
}
