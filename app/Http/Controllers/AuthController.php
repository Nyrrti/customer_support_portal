<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Login User - Check if login data match and if so login, if it fails deny entry and give a error
     * 
     * @param LoginRequest - Form request Pre-checks login input values
     */
    public function login(LoginRequest $request) 
    {
        $credentials = $request->validated();
        
        if(!Auth::attempt($credentials)) {
            // Return a general login error, not a field-specific validation error.
            // __("auth.failed") gets the "failed" message from the auth translation file.
            return response()->json([
                "message" => __("auth.failed"),
            ], 401);   
        }

        $request->session()->regenerate();
        return response()->json([
            'message' => __("auth.login_success"),
        ]);

    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => __("auth.logout_success"),  
        ]);
    }
}
