<?php

namespace App\Http\Controllers;

use App\Models\AutoCut;
use Illuminate\Http\Request;

class AutoCutController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|string',
            'deduction_date' => 'required|date',
            'frequency' => 'required|in:monthly,weekly',
        ]);
    
        $autoCut = AutoCut::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'description' => $request->description,
            'category' => $request->category,
            'deduction_date' => $request->deduction_date,
            'frequency' => $request->frequency,
        ]);
    
        return response()->json($autoCut, 201);
    }
}
