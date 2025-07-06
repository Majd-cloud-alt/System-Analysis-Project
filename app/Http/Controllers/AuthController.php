<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate(
            [
                'name'=>'required|string|max:255',
                'email'=>'required|string|email|max:255|unique:users,email',
                'password'=>'required|string|min:8|confirmed',
            ]
        );
       $user=User::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]
        );

        return response()->json([
            "message"=>"User Registered Successfully !!",
            "User"=>$user,
            201
        ]);

    }

    public function login(Request $request)
    {
         $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
       ]);

        if(!Auth::attempt($request->only('email','password')))
        {
            return response()->json(['message'=>'invalid email or password'],401);
        }

        $user=User::where('email',$request->email)->firstOrFail();
        $token=$user->createToken('auth_Token')->plainTextToken;

          return response()->json([
            "message"=>"Login Successfully !!",
            "User"=>$user,
            "Token"=>$token,
            201
        ]);

    }

    public function logout(Request $request)
    {
         $request->user()->currentAccessToken()->delete();

        return response()->json([
        'message' => 'Logged out successfully.'
        ]);
    }

























   /* public function register(Request $request)
    {
        $fildes=$request->validate(
            [
                'name'=>'required|max:2550',
                'email'=>'required|email|unique:users',
                'password'=>'required|confirmed'

            ]
        );
       $user=User::create($fildes);
       $token=$user->createToken($request->name);
        return [
            'user'=>$user,
            'token'=>$token->plainTextToken,
        ];
    }
    public function login(Request $request)
    {
        $request->validate(
            [
                'email'=>'required|email|exists:users',
                'password'=>'required'
            ]
        );
        $user=User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password))
        {
            return [
                'message'=>'Incorrect'
            ];
        }

        $token=$user->createToken($user->name);
        return [
            'user'=>$user,
            'token'=>$token->plainTextToken,
        ];

    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
         return [
                'message'=>'logged out'
            ];
    }*/


}
