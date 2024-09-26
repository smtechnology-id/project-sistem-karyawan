<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    // Satuan Kerja
    public function satuanKerja()
    {
        $satuanKerja = WorkUnit::all();
        return view('admin.satuan-kerja', compact('satuanKerja'));
    }

    public function satuanKerjaCreate()
    {
        return view('admin.satuan-kerja.create');
    }

    public function satuanKerjaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $satuanKerja = new WorkUnit();
        $satuanKerja->name = $request->name;
        $satuanKerja->save();
        return redirect()->route('admin.satuan-kerja')->with('success', 'Satuan Kerja Berhasil Ditambahkan');
    }

    public function satuanKerjaUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $satuanKerja = WorkUnit::find($request->id);
        $satuanKerja->name = $request->name;
        $satuanKerja->save();
        return redirect()->route('admin.satuan-kerja')->with('success', 'Satuan Kerja Berhasil Diubah');
    }

    public function satuanKerjaDelete($id)
    {
        $satuanKerja = WorkUnit::find($id);
        $satuanKerja->delete();
        return redirect()->route('admin.satuan-kerja')->with('success', 'Satuan Kerja Berhasil Dihapus');
    }

    // Karyawan
    public function karyawan()
    {
        $karyawan = Employee::all();
        return view('admin.karyawan', compact('karyawan'));
    }

    public function karyawanCreate()
    {
        $satuanKerja = WorkUnit::all();
        return view('admin.karyawan-create', compact('satuanKerja'));
    }

    public function karyawanStore(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'nama' => 'required|string|max:255',
            'satuan_kerja' => 'required|exists:work_units,id',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 'user';
        $user->save();

        $idUser = $user->id;

        $karyawan = new Employee();
        $karyawan->user_id = $idUser;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/employees', $photoName);
            $karyawan->photo = 'employees/' . $photoName; 
        }
        $karyawan->nama = $request->nama;
        $karyawan->work_unit_id = $request->satuan_kerja;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->save();

        return redirect()->route('admin.karyawan')->with('success', 'Karyawan Berhasil Ditambahkan');
    }

    public function karyawanEdit($id)
    {
        $karyawan = Employee::find($id);
        $satuanKerja = WorkUnit::all();
        return view('admin.karyawan-edit', compact('karyawan', 'satuanKerja'));
    }

    public function karyawanUpdate(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'nama' => 'required|string|max:255',
            'satuan_kerja' => 'required|exists:work_units,id',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
            'password_confirmation' => 'nullable|same:password',
        ]);

        $karyawan = Employee::find($request->id);
        $karyawan->nama = $request->nama;
        $karyawan->work_unit_id = $request->satuan_kerja;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->save();

        $user = User::find($karyawan->user_id);
        $user->name = $request->nama;
        $user->email = $request->email;
        if ($request->password) {   
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.karyawan')->with('success', 'Karyawan Berhasil Diubah');
    }

    public function karyawanDelete($id)
    {
        $karyawan = Employee::find($id);
        $user = User::find($karyawan->user_id);
        $user->delete();
        $karyawan->delete();
        return redirect()->route('admin.karyawan')->with('success', 'Karyawan Berhasil Dihapus');
    }

    // Profile
    public function profile()
    {
        return view('admin.profile');
    }
}
