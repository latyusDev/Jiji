<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $userDetails = $request->safe()->only(['first_name','last_name',
                                            'email','password']);
        $userDetails['password'] = Hash::make($userDetails['password']);
        $user = User::create($userDetails);
        $userAddress = $request->safe()->only(['state','street','local_government']);
        $userAddress['addresable_type'] = User::class;
        $userAddress['addresable_id'] = $user->id;
        Address::create($userAddress);
        $token = $user->createToken('latyus')->plainTextToken;
        $response = ['user' => $user,'token' => $token];
        return response($response, 201);
    }

    public function login(LoginUserRequest $request)
    {   
        $userDetails = $request->validated();
        // return $userDetails;
        $user = User::whereEmail($userDetails['email'])->first();
        if(!$user || Hash::check($user->password, $userDetails['password']))
        {
            return response([
                'message'=>'User credentials not found'
            ],401);
        }
        $token = $user->createToken('latyus')->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ],201);
        
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message'=>'You are Logged out']);
    }
}
