<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'type' => 'required|in:income,expense',
            'category' => 'required|string',
            'date' => 'required|date',
        ]);
    
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->type,
            'category' => $request->category,
            'date' => $request->date,
        ]);
    
        return response()->json([
            'status' => 'success',
            'data' => $transaction,
            'message' => 'Transaksi berhasil dibuat'
        ], 201);
    }
}
