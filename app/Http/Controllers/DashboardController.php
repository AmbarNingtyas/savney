<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function summary(Request $request)
    {
        $user = $request->user();

        $income = $user->transactions()->where('type', 'income')->sum('amount');
        $expense = $user->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        return response()->json([
            'balance' => $balance,
            'income' => $income,
            'expense' => $expense,
        ]);
    }
}
