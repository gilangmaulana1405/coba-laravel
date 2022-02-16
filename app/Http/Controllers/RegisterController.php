<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|min:5|max:255',
            'email' => 'required|email:dns|unique:users|',
            'password' => 'required|min:3|max:255'
        ]
        // [
        //      custom message 
        //     'name.required' => 'Nama harus diisi'
        // ]
    );

        // enkripsi password
        $validateData['password'] = bcrypt($validateData['password']);

        // simpan data
        User::create($validateData);

        // pesan berhasil
        $request->session()->flash('success', 'Registration successfully! Please login');

        return redirect('/login');
    }


}
