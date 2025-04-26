<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return Siswa::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
            'kelas' => 'required',
            'status_pembayaran' => 'required'
        ]);
    
        $siswa = Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'status_pembayaran' => $request->status_pembayaran
        ]);
    
        return response()->json(['message' => 'Data siswa berhasil ditambahkan', 'siswa' => $siswa]);
    }
    

    public function show($id)
    {
        $siswa = Siswa::find($id);
    
        if (!$siswa) {
            return response()->json(['message' => 'Data siswa tidak ditemukan'], 404);
        }
    
        return response()->json($siswa);
    }
    
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
    
        if (!$siswa) {
            return response()->json(['message' => 'Data siswa tidak ditemukan'], 404);
        }
    
        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'status_pembayaran' => $request->status_pembayaran,
        ]);
    
        return response()->json(['message' => 'Data siswa berhasil diperbarui', 'data' => $siswa]);
    }
    

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
    
        if (!$siswa) {
            return response()->json(['message' => 'Data siswa tidak ditemukan'], 404);
        }
    
        $siswa->delete();
    
        return response()->json(['message' => 'Data siswa berhasil dihapus']);
    }
    
}
