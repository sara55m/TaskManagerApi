<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|string|unique:users,email',
            'password'=>'required|min:8|string|confirmed',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return response()->json('User Registered Successfully');

    }

    public function login(Request $request){
        return response()->json('true');
    }

    public function logout($id){
        return response()->json('true');
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