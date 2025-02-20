<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::orderBy('no_anggota')->paginate(10)->onEachSide(1);

        return Inertia::render('Admin/Dashboard', compact('users'));
    }
}
