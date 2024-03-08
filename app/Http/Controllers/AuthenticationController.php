<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
class AuthenticationController extends Controller
{


    public function redirectgoolge(){

    return Socialite::driver('google')->redirect();
        }
    public function callbackgoogle(){
       $user = Socialite::driver('google')->user();
        $user1 = User::where('social_id',$user->id)->first();
      
       $user1 = User::where('social_id',$user->id)->first();
        if($user1){
            $token = JWTAuth::fromUser($user1);
            return response()->json([
                "status" => true,
                "message" => "User logged in succcessfully",
                "token" => $token
            ]);
        }
       else {
      ;
        $user = User::create([
            "nom" => $user->name,
            "prenom" => $user->name,
            "email" => $user->email,
            "social_id" => $user->id,
           $password = Str::random(8),
            "password" => Hash::make($password),
            "role"=> "user",
            "social_type" => "google"
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json([
            "status" => true,
            "message" => "User registered successfully",
            "token" => $token
        ]);
       }

    }
  
    public function Register(Request $request){
     
        $request->validate([
          
            "email" => "unique:users",
            
            
        ]);

        // User Model
        User::create([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "tel" => $request->tel,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role"=> "user"
        ]);

        // Response
        return response()->json([
            "status" => true,
            "message" => "User registered successfully"
        ]);
    }
    public function Login(Request $request){
        
       

        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!empty($token)){

            return response()->json([
                "status" => true,
                "message" => "User logged in succcessfully",
                "token" => $token
            ]);
        }
        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ]);
    }
    public function refreshToken(){
        
        $newToken = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $newToken
        ]);
    }
    public function logout(){
        
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
    public function profile(){
            
            $user = auth()->user();
    
            return response()->json([
                "status" => true,
                "message" => "User profile",
                "data" => $user
            ]);
    }
}
