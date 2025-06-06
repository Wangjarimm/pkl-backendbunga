<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;  // Ganti dari Payment ke Transaksi
use App\Models\Payment;
use App\Models\Siswa;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



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
            'payment_id' => 'required|exists:payments,id',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'va_number' => 'required',
            'note' => 'nullable|string',
            'amount' => 'required|integer',
            'tanggal_setor' => 'required|date',
        ]);
        
        $payment = Payment::findOrFail($request->payment_id);
        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $request->nis)->firstOrFail();
    
        // Simpan transaksi
        $transaksi = Transaksi::create([
            'payment_id' => $payment->id,
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
    
 public function handleCallback(Request $request)
{
    try {
        // Log payload untuk debugging
        Log::info('Midtrans callback received:', $request->all());

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        $serverKey = config('midtrans.server_key');

        // Validasi signature
        $expectedSignature = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($expectedSignature !== $request->signature_key) {
            Log::warning('Invalid Midtrans signature', [
                'expected' => $expectedSignature,
                'received' => $request->signature_key
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Cari transaksi berdasarkan order_id
        $transaksi = Transaksi::where('order_id', $request->order_id)->first();

        if (!$transaksi) {
            Log::error('Transaksi tidak ditemukan untuk order_id ' . $request->order_id);
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $status = $request->transaction_status;

        // Jika transaksi berhasil (settlement)
        if ($status === 'settlement') {
            \Illuminate\Support\Facades\DB::transaction(function () use ($transaksi) {
                // Update status transaksi
                $transaksi->status = 'success';
                $transaksi->save();

                // Update status payment
                $payment = Payment::find($transaksi->payment_id);
                if ($payment) {
                    $payment->status = 'success';
                    $payment->save();

                    // Update status setiap tagihan yang dibayar
                    foreach ($payment->paymentDetails as $detail) {
                        $tagihan = \App\Models\TagihanSiswa::find($detail->tagihan_siswa_id);
                        if ($tagihan) {
                            $tagihan->status = 'lunas';
                            $tagihan->save();
                        }
                    }
                }
            });
        } elseif (in_array($status, ['cancel', 'deny', 'expire'])) {
            $transaksi->status = 'failed';
            $transaksi->save();
        } else {
            $transaksi->status = $status; // pending, etc
            $transaksi->save();
        }

        return response()->json(['message' => 'Transaksi diperbarui'], 200);

    } catch (\Exception $e) {
        Log::error('Callback error: ' . $e->getMessage());
        return response()->json(['message' => 'Internal Server Error'], 500);
    }
}


    public function riwayatByNIS($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();

        $riwayat = Transaksi::where('siswa_id', $siswa->id)
            ->orderBy('tanggal_setor', 'desc')
            ->get();

        return response()->json($riwayat);
    }

}

