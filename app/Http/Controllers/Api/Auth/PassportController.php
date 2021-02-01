<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class PassportController extends BaseController
{

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->sendError("Failed to create account", $validator->errors(), 401);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $success['username'] = $user->username;
        $success['token'] = $user->createToken('apiToken')->accessToken;

        return $this->sendResponse($success, "Account created");
    }

    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('apiToken')->accessToken;
            return $this->sendResponse($success, "Login Success");
        } else {
            return $this->sendError("Login Failed", null, 401);
        }
    }

}
