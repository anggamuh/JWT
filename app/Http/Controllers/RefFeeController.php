<?php

namespace App\Http\Controllers;

use App\Models\RefFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefFeeController extends Controller
{
    public function index()
    {
        $fees = RefFee::all();

        return response()->json([
            'code' => 200,
            'message' => 'Data biaya berhasil diambil',
            'data' => $fees
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'registration_fee' => 'required|numeric|min:0',
            'monthly_fee' => 'required|numeric|min:0',
        ], [
            'date.required' => 'Tanggal wajib diisi',
            'date.date' => 'Format tanggal tidak valid',
            'registration_fee.required' => 'Biaya pendaftaran wajib diisi',
            'registration_fee.numeric' => 'Biaya pendaftaran harus berupa angka',
            'monthly_fee.required' => 'Biaya bulanan wajib diisi',
            'monthly_fee.numeric' => 'Biaya bulanan harus berupa angka',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $fee = RefFee::create($request->only(['date', 'registration_fee', 'monthly_fee']));

        return response()->json([
            'code' => 201,
            'message' => 'Data biaya berhasil ditambahkan',
            'data' => $fee
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $fee = RefFee::find($id);

        if (!$fee) {
            return response()->json([
                'code' => 404,
                'message' => 'Data biaya tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'registration_fee' => 'required|numeric|min:0',
            'monthly_fee' => 'required|numeric|min:0',
        ], [
            'date.required' => 'Tanggal wajib diisi',
            'date.date' => 'Format tanggal tidak valid',
            'registration_fee.required' => 'Biaya pendaftaran wajib diisi',
            'registration_fee.numeric' => 'Biaya pendaftaran harus berupa angka',
            'monthly_fee.required' => 'Biaya bulanan wajib diisi',
            'monthly_fee.numeric' => 'Biaya bulanan harus berupa angka',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $fee->update($request->only(['date', 'registration_fee', 'monthly_fee']));

        return response()->json([
            'code' => 200,
            'message' => 'Data biaya berhasil diperbarui',
            'data' => $fee
        ], 200);
    }

    public function destroy($id)
    {
        $fee = RefFee::find($id);

        if (!$fee) {
            return response()->json([
                'code' => 404,
                'message' => 'Data biaya tidak ditemukan',
            ], 404);
        }

        $fee->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Data biaya berhasil dihapus'
        ], 200);
    }

    public function show($id)
    {
        $fee = RefFee::find($id);

        if (!$fee) {
            return response()->json([
                'code' => 404,
                'message' => 'Data biaya tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Data biaya berhasil diambil',
            'data' => $fee
        ], 200);
    }
}
