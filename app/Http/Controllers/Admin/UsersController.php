<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notification\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class UsersController extends Controller
{
    
    public function index(Request $request)
    {
        $query = User::where('id', '!=', $request->user()->id);

        if ($request->has('search')) {
            $query->where('no_anggota', 'like', $request->search . '%');
        }

        $users = $query->orderBy('no_anggota')->paginate(10)->onEachSide(1);

        return Inertia::render('Admin/Users/Index', compact('users'));
    }

    public function show(User $user)
    {
        return Inertia::render('Admin/Users/Show', compact('user'));
    }

    public function create(Request $request)
    {

        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request)
    {
        // dd($request->input());
        $rules = [
            'no_anggota' => ['required', 'string', 'min:14', 'max:14'],
            'nama' => ['required', 'string'],
            'tanggal_lahir' => [],
            'tempat_lahir' => [],
            'agama' => [],
            'unlat' => [],
            'tahun_angkatan' => [],
            'alamat' => [],
            'foto' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:4096'],
        ];

        $rulesAccount = [
            'username' => ['required', 'string', 'min:4'],
            'password' => ['required']
        ];

        $withAccount = filter_var($request->withAccount, FILTER_VALIDATE_BOOLEAN);
        if ($withAccount) {
            $rules = array_merge($rules, $rulesAccount);
        }

        $request->validate($rules);

        $existingUser = User::where('no_anggota', $request->no_anggota)
            ->orWhere(function ($query) use ($withAccount, $request) {
                if ($withAccount) {
                    $query->where('username', $request->username);
                }
            })->first();

        if ($existingUser) {
            $errors = [];
            if ($existingUser->no_anggota === $request->no_anggota) {
                $errors['no_anggota'] = 'No. Anggota already exists';
            }
            if ($withAccount && $existingUser->username === $request->username) {
                $errors['username'] = 'Username already exists';
            }

            return back()->withErrors($errors);
        }

        $userData = $request->all();
        if ($withAccount) {
            $userData['password'] = bcrypt($request->password);
        } else {
            $userData['username'] = null;
            $userData['password'] = null;
        }
        $user = User::create($userData);

        $foto = $request->file('foto');
        if ($foto) {
            $fileName = 'foto_' . $user->id . '.' . $foto->extension();
            $foto->move(public_path('foto'), $fileName);
            $user->foto = 'foto/' . $fileName;
            $user->update();
        }

        // return response()->json($user);
        return back()->with('toasts', [new Toast('User saved successfully', 'success')]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // dd($request->input());
        $rules = [
            'no_anggota' => ['required', 'string', 'min:14', 'max:14'],
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
            'withAccount' => filter_var($request->withAccount, FILTER_VALIDATE_BOOLEAN),
        ]);

        if(!$user->foto && ! $request->photoDeleted){
            $rules = array_merge($rules, [
                'foto' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:4096']
            ]);
        }

        $withAccount = $request->withAccount;
        if ($withAccount) {
            $rules = array_merge($rules, [
                'username' => ['required', 'string', 'min:4']
            ]);

            if(!$user->username && !$request->password){
                return back()->withErrors([
                    'password' => 'The password field is required.'
                ]);
            }
        }

        $request->validate($rules);

        $existingUser = User::where('id', '!=', $user->id)
            ->where(function ($query) use ($withAccount, $request) {
                $query->where('no_anggota', $request->no_anggota);
                if ($withAccount) {
                    $query->orWhere('username', $request->username);
                }
            })->first();

        if ($existingUser) {
            $errors = [];
            if ($existingUser->no_anggota === $request->no_anggota) {
                $errors['no_anggota'] = 'No. Anggota already exists';
            }
            if ($withAccount && $existingUser->username === $request->username) {
                $errors['username'] = 'Username already exists';
            }

            return back()->withErrors($errors);
        }

        $userData = $request->all();
        if ($withAccount) {
            $userData['password'] = bcrypt($request->password);
        } else {
            $userData['username'] = null;
            $userData['password'] = null;
        }

        $foto = $request->file('foto');
        if($user->foto && ($foto || $request->photoDeleted)){
            File::delete(public_path($user->foto));
        }
        if ($foto) {
            $fileName = 'foto_' . $user->id . '.' . $foto->extension();
            $foto->move(public_path('foto'), $fileName);
            $userData['foto'] = 'foto/' . $fileName;
        }

        $user->update($userData);

        // return response()->json($user);
        return back()->with('toasts', [new Toast('User updated successfully', 'success')]);
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return redirect()->route('users.index', $request->query())->with('toasts', [new Toast('User deleted successfully', 'success')]);
    }
}
