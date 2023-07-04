<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::firstWhere('email', $request->email);

        abort_unless($user && Hash::check($request->password, $user->password), 422, "Invalid Credentials");

        $user->access_token = $user->createToken('api')->plainTextToken;

        return LoginResource::make($user);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $user->access_token = $user->createToken('api')->plainTextToken;

        return LoginResource::make($user);
    }
}
