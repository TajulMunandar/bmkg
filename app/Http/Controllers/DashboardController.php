<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Mahasiswa;
use App\Models\Umum;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $umum = Umum::where('status', 0)->count();
        $mahasiswa = Mahasiswa::where('status', 0)->count();
        $instansi = Instansi::where('status', 0)->count();
        return view('dashboard.page.index')->with(compact('umum', 'mahasiswa', 'instansi'));
    }
}
