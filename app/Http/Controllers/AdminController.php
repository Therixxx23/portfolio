<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $adminUser = env('ADMIN_USERNAME', 'admin');
        $adminPass = env('ADMIN_PASSWORD', 'password');

        if (
            $request->username === $adminUser &&
            $request->password === $adminPass
        ) {
            Session::put('admin_authenticated', true);
            Session::put('admin_username', $request->username);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['Invalid credentials.']);
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'projectCount' => 2,
            'gameCount' => 1,
        ]);
    }

    public function logout()
    {
        Session::forget('admin_authenticated');
        Session::forget('admin_username');
        return redirect()->route('admin.login');
    }
}
