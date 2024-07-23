<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authenticate(UserLoginRequest $request){
        $credentials = $request->only("email","password");

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'status' => true,
                'message'=> 'Success!'
            ]);
        }

        return response()->json([
            'status' => false,
            'message'=> 'Invalid Credentials'
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
