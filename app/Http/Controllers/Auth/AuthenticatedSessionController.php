<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends AppBaseController
{
    public function usarname()
    {
        return 'username';
    }
    protected function credentials()
    {
        return [
            'username' => 'haacosta',
            'password' => 'Produccion01'
        ];
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $credentials = $this->credentials();
        dd($credentials,Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return $this->sendResponse(['Usuario' => $user], 'Acceso satisfactorio');
        }else{
            return $this->sendError('Usuario No conecta');
        }

        $request->authenticate();
        $token = $request->user()->createToken('token')->plainTextToken;
        $user = Auth::user();
        // return response()->json(['user'=> $user,'token' => $token]);
        return $this->sendResponse(['Usuario' => $user,'Token' => $token], 'Acceso satisfactorio');
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
