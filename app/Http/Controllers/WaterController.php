<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IssiqSuvService;
use App\Services\UserDebtService;
use App\Helpers\ApiResponse;

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

        try {
            $data = $service->create($validated);
            return ApiResponse::success($data, 'Issiq suv maʼlumotlari qo‘shildi', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Issiq suv qo‘shishda xatolik: ' . $e->getMessage(), 500);
        }
    }

    public function createUserDebt(Request $request, UserDebtService $service)
    {
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'is_debt'     => 'required|boolean',
            'debt_amount' => 'required|numeric',
        ]);

        try {
            $data = $service->create($validated);
            return ApiResponse::success($data, 'Foydalanuvchining qarzdorligi qo‘shildi', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Qarzdorlikni qo‘shishda xatolik: ' . $e->getMessage(), 500);
        }
    }
}
