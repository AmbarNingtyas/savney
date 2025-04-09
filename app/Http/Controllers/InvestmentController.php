<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function predict(Request $request)
    {
        $data = $request->validate([
            'current_balance' => 'required|numeric|min:0',
            'monthly_interest' => 'required|numeric|min:0|max:100',
            'target_amount' => 'required|numeric|min:0'
        ]);
    
        $months = 0;
        $current = $data['current_balance'];
        $details = [];
        
        while ($current < $data['target_amount']) {
            $months++;
            $current *= (1 + ($data['monthly_interest']/100));
            $details[] = [
                'month' => $months,
                'balance' => round($current, 2)
            ];
        }
    
        return response()->json([
            'estimated_months' => $months,
            'projection' => $details
        ]);
    }
}
