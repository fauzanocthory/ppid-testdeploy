<?php

namespace App\Http\Controllers\Panel\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'nip';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'nip' => 'required|numeric',
            'password' => 'required|string',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP hanya boleh berisi angka.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

    }

    public function showLoginForm()
    {
        return view('panel.pages.auth.login');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'invalid' => ['Login gagal. Cek kembali NIP dan kata sandi.'],
        ]);
    }

    protected function redirectTo()
    {
        return route('panel.dashboard');
    }
    protected function loggedOut(Request $request)
    {
        return redirect()->route('panel.auth.login');
    }


}
