<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParentController extends Controller
{
    public function index()
    {
        $parents = ParentModel::all();

        return response()->json([
            'code' => 200,
            'message' => 'Data orang tua berhasil diambil',
            'data' => $parents
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone_number_r' => ['nullable', 'string', 'max:20'],
            'phone_number_f' => ['nullable', 'string', 'max:20'],
            'emergency_number' => ['nullable', 'string', 'max:20'],
        ]);

        $parent = ParentModel::create($validated);

        return response()->json([
            'code' => 201,
            'message' => 'Data orang tua berhasil ditambahkan',
            'data' => $parent
        ], 201);
    }

    public function show($id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json([
                'code' => 404,
                'message' => 'Data orang tua tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Data orang tua berhasil ditemukan',
            'data' => $parent
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json([
                'code' => 404,
                'message' => 'Data orang tua tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone_number_r' => ['nullable', 'string', 'max:20'],
            'phone_number_f' => ['nullable', 'string', 'max:20'],
            'emergency_number' => ['nullable', 'string', 'max:20'],
        ]);

        $parent->update($validated);

        return response()->json([
            'code' => 200,
            'message' => 'Data orang tua berhasil diperbarui',
            'data' => $parent
        ], 200);
    }

    public function destroy($id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json([
                'code' => 404,
                'message' => 'Data orang tua tidak ditemukan'
            ], 404);
        }

        $parent->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Data orang tua berhasil dihapus'
        ], 200);
    }
}
