<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // دالة عرض صفحة التسجيل (Standard Name: create)
    public function create()
    {
        return view('signup');
    }

    // دالة حفظ المستخدم الجديد (Standard Name: store)
    public function store(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required|string|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        // need the model here to access the DB users table
        User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password'])
        ]);

        return redirect('/')->with('success', 'Account created successfully');
    }

    // دالة عرض صفحة تسجيل الدخول (نقلناها هنا عشان الترتيب)
    public function showLogin()
    {
        return view('login');
    }

    // دالة عملية تسجيل الدخول (Standard Logic)
    public function login(Request $req)
    {
        $credentials = $req->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (Auth::attempt($credentials)) { // check credentials and return true/false
            $req->session()->regenerate(); // protect from stealing sessions

            return redirect()->intended('/'); // redirect to the intended url or /
        }

        // back: redirect to the previous page with errors
        // withErrors: add errors to the session
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $req)
    {
        Auth::logout(); // 1. تسجيل خروج من النظام
        $req->session()->invalidate(); // 2. تدمير السيشن القديم
        $req->session()->regenerateToken(); // 3. تغيير توكن الحماية (أمان)

        return redirect('/'); // رجعه للصفحة الرئيسية
    }
}
