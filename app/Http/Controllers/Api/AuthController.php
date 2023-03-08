<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Register User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(SignupRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $user->createToken("API_TOKEN")->plainTextToken,
                ],
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Login User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'errors' => 'Provided email address or password is incorrect',
                ], 422);
            }

            $user = User::where('email', $request->email)->first();
            $user->tokens()->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $user->createToken("API_TOKEN")->plainTextToken,
                ],
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => '$exception->getMessage()'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ( $user ) {
            $user->tokens()->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Logged Out Successfully',
        ], 200);
    }    
}
