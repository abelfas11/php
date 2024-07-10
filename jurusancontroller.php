<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    // Fungsi untuk membuat data baru
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Pastikan kolom 'foto' sudah dimasukkan di dalam array data
        $jurusan = Jurusan::create($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'Jurusan created successfully',
            'data' => $jurusan,
        ], 201);
    }


    // Fungsi untuk memperbarui data
    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json(['message' => 'Jurusan not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|nullable|string',
            'deskripsi' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $jurusan->update($data);

        return response()->json([
            'message' => 'User ID ' . $jurusan->id . ' updated',
            'data' => $jurusan
        ], 200);
    }

    // Fungsi untuk menghapus data
    public function delete($id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json(['message' => 'Jurusan not found'], 404);
        }

        $jurusan->delete();

        return response()->json([
            'message' => 'Jurusan deleted'
        ], 200);
    }

    // Fungsi untuk mendapatkan data
    public function get(Request $request)
    {
        $id = $request->input('id');
        $jurusan= Jurusan::select('*');
        if ($id) {
            $jurusan->where('id', $id);
        }
        $getjurusan = $jurusan->get();

        return response()->json($getjurusan);
    }
}