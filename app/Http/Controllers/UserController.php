<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(UserLoginRequest $request)
    {
        try {
            $email = $request->email;

            $password = $request->password;

            $credentials = User::where('email', $email)->first();

            if (!is_null($credentials) && Hash::check($password, $credentials->password)) {

                $token = $credentials->createToken($credentials->id)->plainTextToken;

                return response()->success($request, ['token' => $token], 'Login successful', 200);

            } else {

                return response()->error($request, ['email' => $email, 'password' => $password], 'Email or Password not correct.', 401);
            }
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(UserRegisterRequest $request)
    {
        try {

            $credentials = $request->validated();

            $user = new User($credentials);

            $user->save();

            return response()->success($request, null, 'Registration successful', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $bear = $request->bearerToken();

            $token = PersonalAccessToken::findToken($bear);

            $token->tokenable->tokens()->delete();

            return response()->success($request, null, 'Logout successful', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }
}
