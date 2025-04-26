<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;  // Ganti dari Payment ke Transaksi
use App\Models\Siswa;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;


class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        return response()->json(Transaksi::with('siswa')->get());
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nis' => 'required|exists:siswas,nis',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'va_number' => 'required',
            'note' => 'nullable|string',
            'amount' => 'required|integer',
            'tanggal_setor' => 'required|date',
        ]);
    
        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $request->nis)->firstOrFail();
    
        // Simpan transaksi
        $transaksi = Transaksi::create([
            'siswa_id' => $siswa->id,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'va_number' => $request->va_number,
            'note' => $request->note,
            'amount' => $request->amount,
            'tanggal_setor' => $request->tanggal_setor,
            'status' => 'pending',
        ]);
    
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    
        // Buat order ID dan parameter transaksi
        $orderId = 'ORDER-' . $transaksi->id . '-' . time();
    
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $transaksi->amount,
            ],
            'customer_details' => [
                'first_name' => $transaksi->nama,
            ],
        ];
    
        // Dapatkan Snap Token menggunakan Snap API
        try {
            $snapToken = Snap::getSnapToken($params);
            
            // Simpan snapToken ke database jika diperlukan
            $transaksi->snap_token = $snapToken;
            $transaksi->order_id = $orderId;
            $transaksi->save();
    
            // Buat URL redirection sesuai dengan format yang diinginkan
            $redirectionUrl = 'https://app.sandbox.midtrans.com/snap/v4/redirection/' . $snapToken;
    
            // Kembalikan respons dengan snap_url dan snap_token
            return response()->json([
                'message' => 'Transaksi berhasil dibuat',
                'data' => $transaksi,
                'snap_url' => $redirectionUrl, // URL redirection ke halaman pembayaran
                'snap_token' => $snapToken,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error getting Snap Token: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error generating Snap Token'], 500);
        }
    }
    
    
    

    // Menampilkan transaksi berdasarkan ID
    public function show($id)
    {
        $transaksi = Transaksi::with('siswa')->findOrFail($id);
        return response()->json($transaksi);
    }

    // Menghapus transaksi berdasarkan ID
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }
}
