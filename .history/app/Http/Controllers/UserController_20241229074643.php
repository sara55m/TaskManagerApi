<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|string|unique:users,email',
            'password'=>'required|min:8|string|confirmed',
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return response()->json([
            'message'=>'User Registered Successfully',
            'User'=>$user,
            201]);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email|max:255|string',
            'password'=>'required|min:8|string',
        ]);
        if(!Auth::attempt($request->only('email','password')))
        //if user credentials do not match
        return response()->json('Invalid Email or Password',401);
        //get the user
        $user=User::where('email',$request->email)->firstOrFail();
        //generate user token
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message'=>'User Logged Successfully',
            'User'=>$user,
            'Token'=>$token,
            201]);
    }

    public function logout(Request $request){
        //delete current user token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message'=>'User Logged Out Successfully',
            201]);
    }
    public function index(){
        $users=User::all();
        //returning the response in json format
        return response()->json($users);
    }


    public function show($user){
        $user=User::find($user);
        if($user){
            //returning the response in json format
        return response()->json($user);
        }else{
            //returning the response in json format
        return response()->json('not found',404);
        }
    }

    public function getProfile($id){
        $user=User::find($id);

        return response()->json($user->profile,200);

    }

    public function getTasks($id){
        $user=User::find($id);

        return response()->json($user->tasks,200);
    }
}
