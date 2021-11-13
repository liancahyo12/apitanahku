<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Admin;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // use Auth;
    public function __construct() {
        // $this->middleware('auth:api', ['except' => ['login', 'register']], 'verified');
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home')
                        ->withSuccess('Signed in');
        }
  
        return back()->with('loginError', 'Email atau password salah silahkan login ulang');
    }

    public function dashboardAdmin()
    {
        if(Auth::guard('admin')->check()){
            return view('home');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function logout() {
        Auth::guard('admin')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
        
        return Redirect('login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
