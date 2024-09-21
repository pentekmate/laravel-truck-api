<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user = User::where('email',$request->email)->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email'=>['The provided credentials are incorrect']
            ]);
        }

        if(!Hash::check($request->password,$user->password)){
            throw ValidationException::withMessages([
                'email'=>['The provided credentials are incorrect']
            ]);
        }



        $token = $user->createToken('api-token')->plainTextToken;
        $user->notify(
            new UserLoggedIn()
        );
        return response()->json([
            'token'=>$token
        ]);

      
     }

     public function logout(Request $request)
     {
         $request->user()->tokens()->delete();
 
         return response()->json([
             'message' => 'Kijelentkezés sikeres'
         ]);
     }
}
