<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    
    /**
     * Authenticate the user and return their profile.
     *
     * Wrong credentials and unconfirmed email addresses are returned as
     * validation errors on the email field, so the form can show them.
     *
     * @param LoginRequest $request The validated login request.
     * @throws ValidationException When login fails or the email is not confirmed.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                "email" => __("auth.failed"),
            ]);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasVerifiedEmail()) {
            Auth::guard("web")->logout();

            throw ValidationException::withMessages([
                "email" => "Please confirm your email first.",
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            "message" => __("auth.login_success"),
            "user" => new UserResource($user),
        ], 200);
    }

    /**
     * Create a new, unconfirmed account and send the verification email.
     *
     * The user is not logged in yet, they must confirm their email first.
     *
     * @param RegisterRequest $request The validated register request.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        // Laravel sends the verification email when this event fires.
        event(new Registered($user));

        return response()->json([
            "message" => "Your account has been created. Check your email to confirm your address.",
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

    /**
     * Send a new verification email to an unconfirmed account.
     *
     * Always returns the same message.
     *
     * @param Request $request The request containing the email address.
     */
    public function resendVerification(Request $request): JsonResponse
    {
        $request->validate(["email" => ["required", "email"]]);

        $user = User::where("email", $request->email)->first();

        if ($user && ! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }

        return response()->json([
            "message" => "If this account exists and is not confirmed yet, a new email has been sent.",
        ]);
    }
}
