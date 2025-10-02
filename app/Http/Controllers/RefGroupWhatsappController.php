<?php

namespace App\Http\Controllers;

use App\Models\RefGroupWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefGroupWhatsappController extends Controller
{
    public function index()
    {
        $data = RefGroupWhatsapp::all();

        return response()->json([
            'code' => 200,
            'message' => 'Data grup WhatsApp berhasil diambil',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|digits:4|integer',
            'link' => 'required|url',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $group = RefGroupWhatsapp::create($request->all());

        return response()->json([
            'code' => 201,
            'message' => 'Data grup WhatsApp berhasil ditambahkan',
            'data' => $group
        ], 201);
    }

    public function show($id)
    {
        $group = RefGroupWhatsapp::find($id);

        if (!$group) {
            return response()->json([
                'code' => 404,
                'message' => 'Data grup WhatsApp tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Data grup WhatsApp berhasil diambil',
            'data' => $group
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $group = RefGroupWhatsapp::find($id);

        if (!$group) {
            return response()->json([
                'code' => 404,
                'message' => 'Data grup WhatsApp tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'year' => 'sometimes|required|digits:4|integer',
            'link' => 'sometimes|required|url',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $group->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Data grup WhatsApp berhasil diperbarui',
            'data' => $group
        ], 200);
    }

    public function destroy($id)
    {
        $group = RefGroupWhatsapp::find($id);

        if (!$group) {
            return response()->json([
                'code' => 404,
                'message' => 'Data grup WhatsApp tidak ditemukan'
            ], 404);
        }

        $group->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Data grup WhatsApp berhasil dihapus'
        ], 200);
    }
}
