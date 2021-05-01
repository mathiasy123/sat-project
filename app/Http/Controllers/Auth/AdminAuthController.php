<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;

// Models
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function index() {
        return view('pages.admins.auth.index')->with('title', 'Admin Login');
    }

    public function login(LoginRequest $request) {
        $validatedRequest = $request->validated();

        if(auth()->guard('admin')->attempt(['email' => $validatedRequest['email'], 'password' => $validatedRequest['password']])) {            
            return redirect()->intended(route('admins.dashboard.index'));
        }

        return redirect()
                ->back()
                ->with('login-invalid', 'Email atau password yang Anda masukkan salah.');
    }

    public function logout() {
        auth()->guard('admin')->logout();
        return redirect()->route('admins.login.index');
    }
}
