<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return response()->json([
            'code' => 200,
            'message' => 'Data file berhasil diambil',
            'data' => $files
        ]);
    }

    public function show($id)
    {
        $file = File::find($id);

        if (!$file) {
            return response()->json([
                'code' => 404,
                'message' => 'File tidak ditemukan'
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'File berhasil diambil',
            'data' => $file
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|exists:members,id',
            'id_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'family_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'club_release_letter' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ]);
        }

        $data = $request->all();

        // Upload file jika ada
        foreach (['id_card','birth_certificate','family_card','club_release_letter'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('files', 'public');
            }
        }

        $file = File::create($data);

        return response()->json([
            'code' => 201,
            'message' => 'File berhasil disimpan',
            'data' => $file
        ]);
    }

    public function update(Request $request, $id)
    {
        $file = File::find($id);
        if (!$file) {
            return response()->json([
                'code' => 404,
                'message' => 'File tidak ditemukan'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'member_id' => 'required|exists:members,id',
            'id_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'family_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'club_release_letter' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ]);
        }

        $data = $request->all();

        // Upload file jika ada
        foreach (['id_card','birth_certificate','family_card','club_release_letter'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('files', 'public');
            }
        }

        $file->update($data);

        return response()->json([
            'code' => 200,
            'message' => 'File berhasil diupdate',
            'data' => $file
        ]);
    }

    public function destroy($id)
    {
        $file = File::find($id);
        if (!$file) {
            return response()->json([
                'code' => 404,
                'message' => 'File tidak ditemukan'
            ]);
        }

        $file->delete();

        return response()->json([
            'code' => 200,
            'message' => 'File berhasil dihapus'
        ]);
    }
}
