<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'details' => 'required|array',
            'details.*.tagihan_siswa_id' => 'required|exists:tagihan_siswa,id',
            'details.*.jumlah_bayar' => 'required|numeric|min:0',
        ]);

        foreach ($request->details as $item) {
            \App\Models\PaymentDetail::create([
                'payment_id' => $request->payment_id,
                'tagihan_siswa_id' => $item['tagihan_siswa_id'],
                'jumlah_bayar' => $item['jumlah_bayar'],
            ]);
        }

        return response()->json(['message' => 'Payment details saved successfully']);
    }
}
