<?php

namespace App\Http\Controllers;

use App\Models\RefRadius;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefRadiusController extends Controller
{
    public function index()
    {
        $data = RefRadius::all();
        return response()->json([
            'code' => 200,
            'message' => 'Data radius berhasil diambil',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $radius = RefRadius::find($id);
        if (!$radius) {
            return response()->json([
                'code' => 404,
                'message' => 'Data radius tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Data radius berhasil diambil',
            'data' => $radius
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $radius = RefRadius::create($request->all());

        return response()->json([
            'code' => 201,
            'message' => 'Data radius berhasil disimpan',
            'data' => $radius
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $radius = RefRadius::find($id);
        if (!$radius) {
            return response()->json([
                'code' => 404,
                'message' => 'Data radius tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'latitude' => 'sometimes|required|numeric|between:-90,90',
            'longitude' => 'sometimes|required|numeric|between:-180,180',
            'radius' => 'sometimes|required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $radius->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Data radius berhasil diperbarui',
            'data' => $radius
        ]);
    }

    public function destroy($id)
    {
        $radius = RefRadius::find($id);
        if (!$radius) {
            return response()->json([
                'code' => 404,
                'message' => 'Data radius tidak ditemukan'
            ], 404);
        }

        $radius->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Data radius berhasil dihapus'
        ]);
    }
}
