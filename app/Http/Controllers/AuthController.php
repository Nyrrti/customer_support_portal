<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Authenticate the user and return their profile
     * 
     * @param LoginRequest $request The validated login request.
     */
   public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                "message" => __("auth.login_success"),
                "user" => new UserResource(Auth::user()),
            ], 200);
        }

        return response()->json([
            "message" => __("auth.failed"),
        ], 401);
    }

    /**
     * Create a new account and log the user in.
     *
     * @param RegisterRequest $request The validated register request.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            "message" => "Your account has been created.",
            "user" => new UserResource($user),
        ], 201);
    }

    /**
     * Return the authenticated user's profile.
     */
    public function user(Request $request): JsonResponse
    {
        return response()->json([
            "user" => new UserResource($request->user()),
        ], 200);
    }

    /**
     * Log out the user and invalidate their session if authenticated.
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return response()->json([
            "message" => __("auth.logout_success"),  
        ]);
    }
}
