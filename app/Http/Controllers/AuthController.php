<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('partials.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('usuario', $credentials['usuario'])->first();

        if ($usuario && $usuario->validatePassword($credentials['password'])) {
            
            Auth::login($usuario);
            $request->session()->regenerate();
            if ($usuario->rol->idRol == 3) { // Cliente
                //return redirect()->intended('/inicio');
                return view('layouts.app');
            } else { // Administrador o Empleado
                //return redirect()->intended('/tienda/inicio');
                return view('layouts.administrador');
            }
        }

        return back()->withErrors([
            'usuario' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}