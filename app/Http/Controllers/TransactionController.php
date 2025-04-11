<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|string',
            'type' => 'required|in:income,expense',
            'date' => 'required|date'
        ]);

        $transaction = $request->user()->transactions()->create($validated);

        return response()->json($transaction, 201);
    }

    public function index(Request $request)
    {
        $transactions = $request->user()->transactions()
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'amount' => 'Rp' . number_format($item->amount, 0, ',', '.'),
                    'description' => $item->description,
                    'category' => $item->category,
                    'type' => $item->type,
                    'date' => date('Y-m-d', strtotime($item->date)),
                ];
            });

        return response()->json($transactions);;
    }
}
