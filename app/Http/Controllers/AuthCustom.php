<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Hash;
use Session;
use App\Models\User;
use App\Models\hr;
use App\Models\intern;
use Illuminate\Support\Facades\Auth;

class AuthCustom extends Controller
{
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $admin = hr::where('user_id', Auth::user()->id)->first();
            $intern = intern::where('user_id', Auth::user()->id)->first();
            return response()->json(['gucci' => true, 'user' => Auth::user(), 'admin' => $admin, 'intern' => $intern]);
        }
   
        return response()->json(['gucci' => false]);
    }

    public function customRegister(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
            
        $data = $request->all();
        $check = $this->create($data);
          
        return response()->json(['gucci' => true, 'user' => $check]);
    }
 
 
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
     
    
}
