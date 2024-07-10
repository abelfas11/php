<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiodataController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'fullname' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'anak' => 'nullable|integer',

        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $biodata = Biodata::create($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'Biodata created successfully',
            'data' => $biodata,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $biodata = Biodata::find($id);

        if (!$biodata) {
            return response()->json(['message' => 'Biodata not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|nullable|string',
            'fullname' => 'sometimes|nullable|string',
            'tanggal_lahir' => 'sometimes|nullable|date',
            'anak' => 'sometimes|nullable|integer',

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

        $biodata->update($data);

        return response()->json([
            'message' => 'User ID ' . $biodata->id . ' updated',
            'data' => $biodata
        ], 200);
    }

    public function delete($id)
    {
        $biodata = Biodata::find($id);

        if (!$biodata) {
            return response()->json(['message' => 'Biodata not found'], 404);
        }

        $biodata->delete();

        return response()->json([
            'message' => 'Biodata deleted'
        ], 200);
    }

    public function get(Request $request)
    {
        $id = $request->query('id');
        if ($id) {
            $biodata = Biodata::find($id);
            if ($biodata) {
                return response()->json($biodata);
            } else {
                return response()->json(['message' => 'Biodata not found'], 404);
            }
        } else {
            $biodata = Biodata::all();
            return response()->json($biodata);
        }
    }
}