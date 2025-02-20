<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchUserController extends Controller
{
    public function index(Request $request)
    {
        $user = null;

        if ($request->has('search')) {
            $user = User::where([
                ['role', '!=', 'admin'],
                ['no_anggota', '=', $request->search]
            ])->first();
        }

        return Inertia::render('User/SearchUser/Index', compact('user'));
    }

    public function show(User $user)
    {
        return Inertia::render('User/SearchUser/Show', compact('user'));
    }
}
