<?php

namespace App\Http\Controllers;

use App\Models\AutoCut;
use Illuminate\Http\Request;

class AutoCutController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|string',
            'deduction_date' => 'required|date'
        ]);

        $autoCut = $request->user()->autoCuts()->create($validated);

        return response()->json($autoCut, 201);
    }

    public function index(Request $request)
    {
        return response()->json($request->user()->autoCuts()->orderBy('deduction_date')->get());
    }
}
