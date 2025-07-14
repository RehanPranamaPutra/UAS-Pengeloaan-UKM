<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        if(Gate::allows('create-user')){
            // Ambil list UKM untuk dropdown
            $ukms = Ukm::orderBy('nama_ukm')->get();
            return view('user.create', compact('ukms'));
        }
        abort(403,'Anda Tidak Memiliki Akses');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', Rule::in(['admin', 'pengelola'])],
            'ukm_id'   => ['nullable', 'exists:rehan_ukms,id'],
        ]);

        if ($data['role'] === 'pengelola') {
            validator($data, ['ukm_id' => 'required'])->validate();
        } else {
            $data['ukm_id'] = null;
        }

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }


    public function edit(User $user)
    {
        if(Gate::allows('role-user',$user)){
            $ukms = Ukm::orderBy('nama_ukm')->get();
            return view('user.edit', compact('user', 'ukms'));
        }
        abort(403, "Anda Tidak Memiliki Akses");
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id)
            ],
            // Password **nullable** agar opsional; cuma dicek min+confirmed bila diisi
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'ukm_id'   => ['nullable', 'exists:rehan_ukms,id'],
        ]);

        // Hanya hash password bila user mengisi field password
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Jangan update kolom password sama sekali
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diupdate.');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
