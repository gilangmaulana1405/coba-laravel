<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function index()
    {
        return view('login.index', [
        'title' => 'Login',
        'active' => 'login'
    ]);
    }

    public function authenticate(Request $request)
    {
       $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // jika percobaan login berhasil
        if (Auth::attempt($credentials)) {
            // fungsi regenerate() untuk menghindari hacking session fixing
            $request->session()->regenerate();

            // intended() redirect ke halaman sebelum dilakukan middleware 
            return redirect()->intended('/dashboard');
        }

        
        // jika percobaan gagal
         return back()->with(['failed' => 'Login failed! Try it again']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
