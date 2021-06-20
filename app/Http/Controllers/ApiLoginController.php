<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(
            [   'email' => $request->email,
                'password' => $request->password
            ]
            )){
                $user = Auth::user();
                $token = $user->createToken('user')->accessToken;

                $data['user'] = $user;
                $data['token'] = $token;

                return response()->json(
                    ['success' => true,
                    'data' => $data,
                    'pesan' => 'Login success'
                    ]);
        }else{
            return response()->json(
                ['success' => false,
                'data' => '',
                'pesan' => 'Login failed'
                ], 401);
        }
    }
}
