<?php

namespace App\Http\Controllers;

use App\Models\TagihanSiswa;
use App\Models\Siswa;
use App\Models\JenisTagihan;
use Illuminate\Http\Request;

class TagihanSiswaController extends Controller
{
    // Menampilkan tagihan siswa
    public function index()
    {
        $tagihanSiswa = TagihanSiswa::with(['siswa', 'jenisTagihan'])->get();
        return response()->json($tagihanSiswa);
    }

    // Menyimpan tagihan siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis_tagihan_id' => 'required|exists:jenis_tagihans,id',
            'status' => 'required|in:lunas,belum lunas',
            'tanggal_tagihan' => 'nullable|date',
        ]);

        $tagihanSiswa = TagihanSiswa::create([
            'siswa_id' => $request->siswa_id,
            'jenis_tagihan_id' => $request->jenis_tagihan_id,
            'status' => $request->status,
            'tanggal_tagihan' => $request->tanggal_tagihan,
        ]);

        return response()->json($tagihanSiswa, 201);
    }

    // Menampilkan tagihan siswa berdasarkan ID
    public function show($id)
    {
        $tagihanSiswa = TagihanSiswa::with(['siswa', 'jenisTagihan'])->findOrFail($id);
        return response()->json($tagihanSiswa);
    }

    // Mengupdate tagihan siswa
    public function update(Request $request, $id)
    {
        $tagihanSiswa = TagihanSiswa::findOrFail($id);

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis_tagihan_id' => 'required|exists:jenis_tagihans,id',
            'status' => 'required|in:lunas,belum lunas',
            'tanggal_tagihan' => 'nullable|date',
        ]);

        $tagihanSiswa->update([
            'siswa_id' => $request->siswa_id,
            'jenis_tagihan_id' => $request->jenis_tagihan_id,
            'status' => $request->status,
            'tanggal_tagihan' => $request->tanggal_tagihan,
        ]);

        return response()->json($tagihanSiswa);
    }

    // Menghapus tagihan siswa
    public function destroy($id)
    {
        $tagihanSiswa = TagihanSiswa::findOrFail($id);
        $tagihanSiswa->delete();

        return response()->json(['message' => 'Tagihan siswa deleted successfully']);
    }

    public function getTagihanByNis(Request $request)
    {
        $nis = $request->nis;
        $kelas = $request->kelas;

        $siswa = Siswa::where('nis', $nis)->first();

        if ($siswa) {
            // Ambil ID jenis tagihan yang sesuai kelas
            $jenisTagihanIds = JenisTagihan::where('kelas', $kelas)->pluck('id');

            // Ambil tagihan siswa yang hanya sesuai dengan jenis tagihan kelas tersebut
            $tagihanSiswa = TagihanSiswa::where('siswa_id', $siswa->id)
                ->whereIn('jenis_tagihan_id', $jenisTagihanIds)
                ->with('jenisTagihan')
                ->get();

            return response()->json($tagihanSiswa);
        }

        return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
    }

    public function bayarBeberapaTagihan(Request $request)
{
    $request->validate([
        'nis' => 'required|string',
        'tagihan_ids' => 'required|array',
        'tagihan_ids.*' => 'exists:tagihan_siswas,id',
    ]);

    $siswa = Siswa::where('nis', $request->nis)->first();

    if (!$siswa) {
        return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
    }

    // Ambil tagihan yang dipilih dan masih belum lunas
    $tagihan = TagihanSiswa::with('jenisTagihan')
        ->where('siswa_id', $siswa->id)
        ->whereIn('id', $request->tagihan_ids)
        ->where('status', 'belum lunas')
        ->get();

    if ($tagihan->isEmpty()) {
        return response()->json(['message' => 'Tidak ada tagihan yang bisa diproses'], 400);
    }

    // Hitung total nominal
    $total = $tagihan->sum(fn($t) => $t->jenisTagihan->nominal);

    // Kirim data tagihan + total saja, tanpa mengubah status
    return response()->json([
        'message' => 'Data pembayaran berhasil dihitung.',
        'jumlah_tagihan' => $tagihan->count(),
        'total_bayar' => $total,
        'rincian_tagihan' => $tagihan,
    ]);
}

}
