<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IssiqSuvService;
use App\Services\UserDebtService;

class WaterController extends Controller
{
    public function createIssiqSuv(Request $request, IssiqSuvService $service)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'is_counter'    => 'required|boolean',
            'water_counter' => 'required|numeric',
            'price'         => 'nullable|numeric',
        ]);

        return response()->json($service->create($validated), 201);
    }

    public function createUserDebt(Request $request, UserDebtService $service)
    {
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'is_debt'     => 'required|boolean',
            'debt_amount' => 'required|numeric',
        ]);

        return response()->json($service->create($validated), 201);
    }
}
