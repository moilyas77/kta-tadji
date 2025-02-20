<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notification\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class UsernamePasswordController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return Inertia::render('Account/UsernamePassword', compact('user'));
    }

    public function updateUsername(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'min:4']
        ]);

        $user = $request->user();
        $checkUsername = User::where([
            ['id', '!=', $user->id],
            ['username', '=', $request->username]
        ])->first();

        if ($checkUsername) {
            return back()->withErrors([
                'username' => 'Username is already exists'
            ]);
        }

        $user->username = $request->username;
        $user->save();

        return back()->with('toasts', [new Toast('Username updated successfully', 'success')]);
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'same:password_confirmation'],
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('toasts', [new Toast('Password updated successfully', 'success')]);
    }
}
