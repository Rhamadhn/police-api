<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function index()
    {
        try {
            $locations = Location::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Locations retrieved successfully.',
                'data' => $locations,
            ]);
        } catch (\Exception $e) {
            Log::error('Error retrieving locations: ' . $e->getMessage());

            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to retrieve locations.',
                'data' => [],
            ], 500);
        }
    }

    public function store(StoreLocationRequest $request)
    {
        try {
            $location = Location::create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Location created successfully.',
                'data' => $location,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating location: ' . $e->getMessage());

            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to create location.',
                'data' => [],
            ], 400);
        }
    }

    public function show(Location $location)
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'Location details retrieved successfully.',
                'data' => $location,
            ]);
        } catch (\Exception $e) {
            Log::error('Error showing location: ' . $e->getMessage());

            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to retrieve location details.',
                'data' => [],
            ], 500);
        }
    }

    public function update(StoreLocationRequest $request, Location $location)
    {
        try {
            $location->update($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Location updated successfully.',
                'data' => $location,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating location: ' . $e->getMessage());

            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to update location.',
                'data' => [],
            ], 500);
        }
    }

    public function destroy(Location $location)
    {
        try {
            $location->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Location deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting location: ' . $e->getMessage());

            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to delete location.',
                'data' => [],
            ], 500);
        }
    }
}
