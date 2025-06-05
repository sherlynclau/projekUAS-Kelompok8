<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Barang dengan stok terbanyak
        $barangTerbanyak = DB::select(
            'SELECT * FROM barang ORDER BY jumlah_stok DESC LIMIT 5'
        );

        // Barang dengan stok terminimum
        $barangTerminimum = DB::select(
            'SELECT * FROM barang ORDER BY jumlah_stok ASC LIMIT 5'
        );

        return view('dashboard.index', compact('barangTerbanyak', 'barangTerminimum'));
    }
    
}
