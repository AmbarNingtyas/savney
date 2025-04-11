<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{ 
    public function store(Request $request)
    {
        $data = $request->validate([
            'current_balance' => 'required|numeric|min:0',
            'monthly_interest' => 'required|numeric|min:0',
            'target_amount' => 'required|numeric|gt:current_balance',
        ]);

        $investment = $request->user()->investments()->create($data);

        return response()->json($investment, 201);
    }
    
    public function predict(Request $request)
    {
        $data = $request->validate([
            'current_balance' => 'required|numeric|min:0',
            'monthly_interest' => 'required|numeric|min:0|max:100',
            'target_amount' => 'required|numeric|gt:current_balance',
        ]);
    
        $balance = $data['current_balance'];
        $interest = $data['monthly_interest'];
        $target = $data['target_amount'];
    
        $months = ceil(log($target / $balance) / log(1 + ($interest / 100)));
        $monthly_profit = round($balance * ($interest / 100), 2);
    
        return response()->json([
            'months_needed' => $months,
            'monthly_profit' => $monthly_profit,
        ]);
    }
    
}
