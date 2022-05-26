<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        // $request->session()->regenerate();

        $token = $request->user()->createToken('token')->plainTextToken;

        // return response()->noContent();
        return response()->json(['token' => $token]);
        // return $this->sendResponse(['token' => $token], 'Acceso satisfactorio');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        Auth::user()->tokens()->delete();

        return response()->json(['token' => 'Token Revocado']);
    }
}
