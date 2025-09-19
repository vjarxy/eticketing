<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pengunjung.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = auth()->user();
        if (password_verify($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Password berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Password lama salah');
        }
    }
}
