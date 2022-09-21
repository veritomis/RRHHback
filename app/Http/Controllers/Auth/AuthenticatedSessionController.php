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
    protected function credentials($data)
    {
        return [
            'samaccountname' => $data['username'],
            'password' =>  $data['password']
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
        $credentials = $this->credentials($request->all());
        if (Auth::attempt($credentials)) {
            // $request->authenticate();
            $token = $request->user()->createToken('token')->plainTextToken;
            $user = Auth::user();
            return $this->sendResponse(['Usuario' => $user,'Token' => $token], 'Acceso satisfactorio');
        }else{
            return $this->sendError('Usuario o Contraseña invalidos');
        }
        // $request->authenticate();
        // $token = $request->user()->createToken('token')->plainTextToken;
        // $user = Auth::user();
        // return $this->sendResponse(['Usuario' => $user,'Token' => $token], 'Acceso satisfactorio');
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
