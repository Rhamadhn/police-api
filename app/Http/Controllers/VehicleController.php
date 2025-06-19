<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVehicleRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        try {

            $vehicles = $request->user()->vehicles;

            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil ditemukan.',
                'data' => $vehicles,
            ]);
        } catch (\Exception $e) {
            Log::error('Error retrieving vehicles: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal mengambil data kendaraan.',
                'data' => [],
            ], 500);
        }
    }

    public function store(StoreVehicleRequest $request)
    {
        try {
            $vehicle = $request->user()->vehicles()->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil ditambahkan.',
                'data' => $vehicle,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating vehicle: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal menambahkan kendaraan.',
                'data' => [],
            ], 400);
        }
    }

    public function show(Vehicle $vehicle)
    {
        try {
            if ($vehicle->user_id != auth()->id()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Akses ditolak! Anda tidak dapat melihat kendaraan ini.',
                ], 403);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Detail kendaraan ditemukan.',
                'data' => $vehicle,
            ]);
        } catch (\Exception $e) {
            Log::error('Error showing vehicle: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal mengambil detail kendaraan.',
                'data' => [],
            ], 500);
        }
    }

    public function update(StoreVehicleRequest $request, Vehicle $vehicle)
    {
        Log::info('USER YANG LOGIN SAAT INI: ' . $request->user()->id);
Log::info('KENDARAAN YANG MAU DIUPDATE PUNYA user_id: ' . $vehicle->user_id);
        try {
            if ($vehicle->user_id !== $request->user()->id) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unauthorized action. Anda bukan pemilik kendaraan ini.',
                    'data' => [],
                ], 403);
            }

            $vehicle->update($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil diupdate.',
                'data' => $vehicle,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating vehicle: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal mengupdate kendaraan.',
                'data' => [],
            ], 500);
        }
    }

    public function destroy(Vehicle $vehicle)
    {
        try {
            if ($vehicle->user_id !== auth()->id()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unauthorized action. Anda bukan pemilik kendaraan ini.',
                    'data' => [],
                ], 403);
            }

            $vehicle->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting vehicle: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal menghapus kendaraan.',
                'data' => [],
            ], 500);
        }
    }
}
