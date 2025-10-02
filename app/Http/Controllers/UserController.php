<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'code' => 200,
            'message' => 'Data pengguna berhasil diambil',
            'data' => $users
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:50|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'role'      => ['required', Rule::in(['admin','user','parent'])],
        ], [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'role.required' => 'Role harus dipilih',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'code' => 201,
            'message' => 'Pengguna berhasil ditambahkan',
            'data' => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'code' => 404,
                'message' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Detail pengguna berhasil diambil',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'code' => 404,
                'message' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'name'      => 'sometimes|required|string|max:255',
            'username'  => ['sometimes','required','string','max:50', Rule::unique('users')->ignore($user->id)],
            'email'     => ['sometimes','required','email', Rule::unique('users')->ignore($user->id)],
            'password'  => 'nullable|string|min:6',
            'role'      => ['sometimes','required', Rule::in(['admin','user','parent'])],
        ], [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 6 karakter',
            'role.required' => 'Role harus dipilih',
        ]);

        if ($request->filled('name')) $user->name = $request->name;
        if ($request->filled('username')) $user->username = $request->username;
        if ($request->filled('email')) $user->email = $request->email;
        if ($request->filled('role')) $user->role = $request->role;
        if ($request->filled('password')) $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'code' => 200,
            'message' => 'Data pengguna berhasil diperbarui',
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'code' => 404,
                'message' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Pengguna berhasil dihapus'
        ], 200);
    }
}
