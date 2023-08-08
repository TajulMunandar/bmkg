<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Mahasiswa;
use App\Models\Umum;
use Illuminate\Http\Request;

class DashboardApproveController extends Controller
{
    public function mahasiswa()
    {
        $mahasiswas = Mahasiswa::all();
        return view('dashboard.page.approve.mahasiswa')->with(compact('mahasiswas'));
    }

    public function approveMahasiswa(Request $request)
    {
        mahasiswa::where('id', $request->id)->update(['status' => 1]);
        return redirect('/dashboard/approve/mahasiswa')->with('success', 'data ' . $request->name .' berhasil di Approve!');
    }

    public function disapproveMahasiswa(Request $request)
    {
        mahasiswa::where('id', $request->id)->update(['status' => 2]);
        return redirect('/dashboard/approve/mahasiswa')->with('success', 'data ' . $request->name .' berhasil di Approve!');
    }

    public function umum()
    {
        $umums = Umum::all();
        return view('dashboard.page.approve.umum')->with(compact('umums'));
    }

    public function approveUmum(Request $request)
    {
        Umum::where('id', $request->id)->update(['status' => 1]);
        return redirect('/dashboard/approve/umum')->with('success', 'data ' . $request->name .' berhasil di Approve!');
    }

    public function disapproveUmum(Request $request)
    {
        Umum::where('id', $request->id)->update(['status' => 2]);
        return redirect('/dashboard/approve/umum')->with('success', 'data ' . $request->name .' berhasil di Approve!');
    }

    public function instansi()
    {
        $instansis = Instansi::all();
        return view('dashboard.page.approve.instansi')->with(compact('instansis'));
    }

    public function approveInstansi(Request $request)
    {
        Instansi::where('id', $request->id)->update(['status' => 1]);
        return redirect('/dashboard/approve/instansi')->with('success', 'data ' . $request->name .' berhasil di Approve!');
    }

    public function disapproveInstansi(Request $request)
    {
        Instansi::where('id', $request->id)->update(['status' => 2]);
        return redirect('/dashboard/approve/instansi')->with('success', 'data ' . $request->name .' berhasil di Approve!');
    }
}
