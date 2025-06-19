<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Officer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Fungsi untuk halaman dashboard
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    // Fungsi untuk menampilkan kendaraan
    public function vahicles()
    {
        $vehicles = Vehicle::all();

        return view('dashboard.vahicles', compact('vehicles'));
    }

    // Fungsi untuk menampilkan petugas
    public function officers()
    {
        $officers = Officer::all();

        return view('dashboard.officers', compact('officers'));
    }
}
