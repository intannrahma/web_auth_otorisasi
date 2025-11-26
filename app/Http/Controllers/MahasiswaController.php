<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{

    public function index(Request $request) {
        $search = $request->input('search');

        $data = Mahasiswa::when($search, function ($query, $search) {
            return $query->where('nim', 'like', "%{$search}%");
        })->paginate(5);

        return view('mahasiswa.index', compact('data', 'search'));
    }

    public function create() {
        return view('mahasiswa.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|regex:/^[a-zA-Z.\s]+$/',
            'nim' => 'required|numeric|digits:12',
            'jurusan' => 'required',
            'email' => 'required|unique:mahasiswas,email',
            'alamat' => 'required',
        ], [
            'nama.regex' => 'Nama tidak boleh mengandung angka!',
            'nim.digits' => 'NIM harus 12 digit!',
            'nim.numeric' => 'NIM tidak boleh mengandung huruf!',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Mahasiswa $mahasiswa) {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa) {
        $request->validate([
            'nama' => 'required|string|regex:/^[a-zA-Z.\s]+$/',
            'nim' => 'required|numeric|min:8',
            'jurusan' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ], [
            'nama.regex' => 'Nama tidak boleh mengandung angka!',
            'nim.min' => 'NIM minimal 8 digit!',
            'nim.numeric' => 'NIM tidak boleh mengandung huruf!',
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('Success', 'Data berhasil diupdate.');
    }

    public function destroy(Mahasiswa $mahasiswa) {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('Success', 'Data berhasil dihapus.');
    }
}
