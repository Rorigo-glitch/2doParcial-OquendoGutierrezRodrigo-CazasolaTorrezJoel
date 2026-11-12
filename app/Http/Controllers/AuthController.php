<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $datos = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'No es un correo válido.',
            'email.unique' => 'Ese correo ya está registrado.',
            'password.required' => 'La clave es obligatoria.',
            'password.min' => 'La clave debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las claves no coinciden.',
        ]);

        Auth::login(User::create($datos));
        $request->session()->regenerate();

        return redirect()->route('panel');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate(['email' => 'required|email', 'password' => 'required']);

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            return redirect()->intended(route('panel'));
        }

        return back()->withErrors(['email' => 'Correo o clave incorrectos.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
