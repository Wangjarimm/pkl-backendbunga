<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiDetail;

class TransaksiDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'details' => 'required|array',
            'details.*.payment_id' => 'required|exists:payments,id',
            'details.*.amount' => 'required|numeric|min:0',
        ]);

        foreach ($request->details as $item) {
            TransaksiDetail::create([
                'transaksi_id' => $request->transaksi_id,
                'payment_id' => $item['payment_id'],
                'amount' => $item['amount'],
            ]);
        }

        return response()->json(['message' => 'Detail transaksi berhasil disimpan']);
    }

    public function index($transaksi_id)
    {
        $details = TransaksiDetail::where('transaksi_id', $transaksi_id)
            ->with('payment')
            ->get();

        return response()->json($details);
    }

    public function destroy($id)
    {
        $detail = TransaksiDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Detail transaksi berhasil dihapus']);
    }
}
