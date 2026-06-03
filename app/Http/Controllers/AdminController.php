<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Game;
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
            'projectCount' => Project::count(),
            'gameCount' => Game::count(),
            'experienceCount' => Experience::count(),
            'educationCount' => Education::count(),
        ]);
    }

    public function logout()
    {
        Session::forget('admin_authenticated');
        Session::forget('admin_username');
        return redirect()->route('admin.login');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('photo')->store('profile', 'public');
        session(['profile_photo' => $path]);

        return back()->with('success', 'Profile photo updated.');
    }
}
