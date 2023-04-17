<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register(Request $request){
        $fields = $request->validate([
            'FullName' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::create([
            'FullName' => $fields['FullName'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('UserToken')->plainTextToken;
        return response()->json(['Token' => $token , 'user' => $user]);
    }
    public function Logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        //check email and password
        $user = User::where('email',$fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json(['message'=> 'email or password not correct'],401);
        }

        $token = $user->createToken('UserToken')->plainTextToken;
        return response()->json(['Token' => $token , 'user' => $user]);
    }
}
