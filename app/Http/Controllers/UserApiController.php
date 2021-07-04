<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDO;

class UserApiController extends Controller
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

    public function registerStore(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'pesan' => "Invalid registration form"
            ], 403);
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->exp = 0;
            $user->count_gold_medal = 0;
            $user->count_silver_medal = 0;
            $user->count_bronze_medal = 0;
            $user->count_challenges_joined = 0;
            $user->count_challenges_hosted = 0;
            $user->save();

            return response()->json([
                'success' => true,
                'data' => $user,
                'pesan' => 'Success'
            ], 201);
        }
    }

    public function getUser($idUser){
        $user = User::find($idUser);

        if($user){
            return response()->json([
                'success' => true,
                'data' => $user,
                'pesan' => 'Success'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'data' => null,
            'pesan' => 'Not found'
        ], 400);
    }
}
