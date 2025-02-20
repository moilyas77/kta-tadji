<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notification\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return Inertia::render('Account/Profile', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'nama' => ['required', 'string'],
            'tanggal_lahir' => [],
            'tempat_lahir' => [],
            'agama' => [],
            'unlat' => [],
            'tahun_angkatan' => [],
            'alamat' => [],
        ];

        $request->merge([
            'photoDeleted' => filter_var($request->photoDeleted, FILTER_VALIDATE_BOOLEAN),
        ]);

        if (!$user->foto && ! $request->photoDeleted) {
            $rules = array_merge($rules, [
                'foto' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:4096']
            ]);
        }

        $request->validate($rules);

        $userData = $request->all();
        $foto = $request->file('foto');
        if ($user->foto && ($foto || $request->photoDeleted)) {
            File::delete(public_path($user->foto));
        }
        if ($foto) {
            $fileName = 'foto_' . $user->id . '.' . $foto->extension();
            $foto->move(public_path('foto'), $fileName);
            $userData['foto'] = 'foto/' . $fileName;
        }

        $user->update($userData);

        return back()->with('toasts', [new Toast('Profile updated successfully', 'success')]);
    }
}
