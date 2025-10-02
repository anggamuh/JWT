<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();

        return response()->json([
            'code' => 200,
            'message' => 'Data member berhasil diambil',
            'data' => $members
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required|exists:parents,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'gender' => 'nullable|in:male,female',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'school' => 'nullable|string|max:255',
            'school_grade' => 'nullable|string|max:100',
            'disease' => 'nullable|string|max:255',
            'has_joined_other_club' => 'boolean',
            'photo' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $member = Member::create($request->all());

        return response()->json([
            'code' => 201,
            'message' => 'Data member berhasil ditambahkan',
            'data' => $member
        ], 201);
    }

    public function show($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json([
                'code' => 404,
                'message' => 'Member tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Detail member berhasil diambil',
            'data' => $member
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json([
                'code' => 404,
                'message' => 'Member tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'parent_id' => 'sometimes|exists:parents,id',
            'user_id' => 'sometimes|exists:users,id',
            'name' => 'sometimes|string|max:255',
            'email' => 'nullable|email',
            'gender' => 'nullable|in:male,female',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'school' => 'nullable|string|max:255',
            'school_grade' => 'nullable|string|max:100',
            'disease' => 'nullable|string|max:255',
            'has_joined_other_club' => 'boolean',
            'photo' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $member->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Data member berhasil diperbarui',
            'data' => $member
        ], 200);
    }

    public function destroy($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json([
                'code' => 404,
                'message' => 'Member tidak ditemukan'
            ], 404);
        }

        $member->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Data member berhasil dihapus'
        ], 200);
    }
}
