<?php

namespace App\Http\Controllers;

use App\Models\JenisTagihan;
use Illuminate\Http\Request;

class JenisTagihanController extends Controller
{
    // Menampilkan semua jenis tagihan
    public function index()
    {
        $jenisTagihans = JenisTagihan::all();
        return response()->json($jenisTagihans);
    }

    // Menyimpan jenis tagihan baru
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|integer|in:10,11,12',
            'nama_tagihan' => 'required|string|max:100',
            'nominal' => 'required|numeric',
        ]);

        $jenisTagihan = JenisTagihan::create([
            'kelas' => $request->kelas,
            'nama_tagihan' => $request->nama_tagihan,
            'nominal' => $request->nominal,
        ]);

        return response()->json($jenisTagihan, 201);
    }

    // Menampilkan jenis tagihan berdasarkan ID
    public function show($id)
    {
        $jenisTagihan = JenisTagihan::findOrFail($id);
        return response()->json($jenisTagihan);
    }

    // Mengupdate jenis tagihan
    public function update(Request $request, $id)
    {
        $jenisTagihan = JenisTagihan::findOrFail($id);

        $request->validate([
            'kelas' => 'required|integer|in:10,11,12',
            'nama_tagihan' => 'required|string|max:100',
            'nominal' => 'required|numeric',
        ]);

        $jenisTagihan->update([
            'kelas' => $request->kelas,
            'nama_tagihan' => $request->nama_tagihan,
            'nominal' => $request->nominal,
        ]);

        return response()->json($jenisTagihan);
    }

    // Menghapus jenis tagihan
    public function destroy($id)
    {
        $jenisTagihan = JenisTagihan::findOrFail($id);
        $jenisTagihan->delete();

        return response()->json(['message' => 'Jenis tagihan Berhasil Dihapus!']);
    }
}
