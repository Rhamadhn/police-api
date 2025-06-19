<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;
use App\Http\Requests\StoreOfficerRequest;
use Illuminate\Support\Facades\Log;

class OfficerController extends Controller
{
    public function index()
    {
        try {
            $officers = Officer::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Data officers berhasil ditemukan.',
                'data' => $officers,
            ]);
        } catch (\Exception $e) {
            Log::error('Error retrieving officers: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal mengambil data officers.',
                'data' => [],
            ], 500);
        }
    }

    public function store(StoreOfficerRequest $request)
    {
        try {
            $officer = Officer::create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Officer berhasil ditambahkan.',
                'data' => $officer,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating officer: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal menambahkan officer.',
                'data' => [],
            ], 400);
        }
    }

    public function show(Officer $officer)
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'Detail officer ditemukan.',
                'data' => $officer,
            ]);
        } catch (\Exception $e) {
            Log::error('Error showing officer: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal mengambil detail officer.',
                'data' => [],
            ], 500);
        }
    }

    public function update(StoreOfficerRequest $request, Officer $officer)
    {
        try {
            $officer->update($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Officer berhasil diupdate.',
                'data' => $officer,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating officer: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal mengupdate officer.',
                'data' => [],
            ], 500);
        }
    }

    public function destroy(Officer $officer)
    {
        try {
            $officer->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Officer berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting officer: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal menghapus officer.',
                'data' => [],
            ], 500);
        }
    }
}
