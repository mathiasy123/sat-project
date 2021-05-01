<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ForgotPasswordRequest;

// Models
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    public function __construct() {
        $this->middleware('guest:customer')->except('logout');
    }

    public function index() {
        return view('pages.customers.auth.index', ['title' => 'Login Pelanggan']);
    }

    public function register() {
        return view('pages.customers.auth.register', ['title' => 'Daftar Akun Pelanggan']);
    }

    public function registerAccount(RegisterRequest $request) {
        $validatedRequest = $request->validated();

        Customer::create($validatedRequest);

        return redirect()
                ->route('customers.login.index')
                ->with('alert-register-success', 'Pendaftaran akun login telah berhasil ! Silahkan login untuk memesan produk kami.');
    }

    public function login(LoginRequest $request) {
        $validatedRequest = $request->validated();

        if(auth()->guard('customer')->attempt(['email' => $validatedRequest['email'], 'password' => $validatedRequest['password']])) {
            return redirect()->intended(route('customers.shopping.index'));
        }

        return redirect()
                ->back()
                ->with('alert-login-invalid', 'Email atau password yang Anda masukkan salah.');
    }

    public function showForgotPassword() {
        return view('pages.customers.auth.forgot-password')->with('title', 'Lupa Password');
    }

    public function forgotPassword(ForgotPasswordRequest $request) {
        $validatedRequest = $request->validated();

        $customer = Customer::where('email', $validatedRequest['email'])->first();
        
        if($customer) {
            $customer->password = $validatedRequest['password'];
            $customer->save();

            return redirect()
                ->route('customers.login.index')
                ->with('alert-forgot-password-success', 'Password Anda telah di ubah, silahkan login kembali.');
        }

        return redirect()
                ->back()
                ->with('alert-email-invalid', 'Email Anda masukkan salah.');
    }

    public function logout() {
        auth()->guard('customer')->logout();
        return redirect()->route('customers.login.index');
    }
}
