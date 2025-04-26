<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;


class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::with('siswa')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:siswas,nis', // Validasi berdasarkan NIS
            'nama' => 'required|string|max:255',   // Validasi nama
            'kelas' => 'required|string|max:255',  // Validasi kelas
            'jurusan' => 'required|string|max:255', // Validasi jurusan
            'va_number' => 'required',             // Validasi nomor VA
            'note' => 'nullable|string',           // Validasi catatan (opsional)
            'amount' => 'required|integer',        // Validasi jumlah pembayaran
            'tanggal_setor' => 'required|date',    // Validasi tanggal setor
        ]);

        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $request->nis)->firstOrFail();

        // Simpan pembayaran dengan siswa_id
        $payment = Payment::create([
            'siswa_id' => $siswa->id,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'va_number' => $request->va_number,
            'note' => $request->note,
            'amount' => $request->amount,
            'tanggal_setor' => $request->tanggal_setor,
        ]);

        return response()->json([
            'message' => 'Payment berhasil dibuat',
            'data' => $payment->load('siswa')
        ], 201);
    }

    // Method untuk melakukan pembayaran berdasarkan data yang dikirimkan
    public function pay(Request $request)
    {
        // Validasi input yang dibutuhkan
        $request->validate([
            'nis' => 'required|exists:siswas,nis', // Validasi NIS siswa
            'nama' => 'required|string|max:255',  // Validasi nama
            'kelas' => 'required|string|max:255', // Validasi kelas
            'jurusan' => 'required|string|max:255', // Validasi jurusan
            'va_number' => 'required',             // Validasi nomor VA
            'note' => 'nullable|string',           // Validasi catatan (opsional)
            'amount' => 'required|integer',        // Validasi jumlah pembayaran
            'tanggal_setor' => 'required|date',    // Validasi tanggal setor
        ]);

        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $request->nis)->firstOrFail();

        // Buat entri pembayaran berdasarkan data yang diterima
        $payment = Payment::create([
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

        // Generate Snap Token
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $payment->id . '-' . time(),
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $payment->nama,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // Menyimpan snap_token dan order_id untuk pembayaran
        $payment->snap_token = $snapToken;
        $payment->order_id = 'ORDER-' . $payment->id . '-' . time(); // Order ID dinamis
        $payment->save();

        // Mengembalikan Snap Token dalam response
        return response()->json(['token' => $snapToken]);
    }


    public function show($id)
    {
        $payment = Payment::with('siswa')->findOrFail($id);
        return response()->json($payment);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Payment berhasil dihapus']);
    }



}
