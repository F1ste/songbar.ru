<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,',
            'phone_number' => 'required|string|max:20',
            'city' => 'nullable|string|max:255',
        ]);

        $user->update($request->validated());

        return redirect()->route('profile.update')->with('success', 'Профиль обновлен успешно.');
    }
}
