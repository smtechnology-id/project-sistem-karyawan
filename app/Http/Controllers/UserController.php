<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function karyawan()
    {
        $karyawan = Employee::all();
        return view('user.karyawan', compact('karyawan'));
    }

    public function satuanKerja()
    {
        $satuanKerja = WorkUnit::all();
        return view('user.satuan-kerja', compact('satuanKerja'));
    }   

    public function profile()
    {
        return view('user.profile');
    }
}
