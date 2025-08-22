<?php

namespace App\Services;

use App\Models\UserDebt;

class UserDebtService
{
    public function create(array $data): UserDebt
    {
        return UserDebt::create([
            'user_id'     => $data['user_id'],
            'is_debt'     => $data['is_debt'],
            'debt_amount' => $data['debt_amount'],
        ]);
    }

    public function getByUserId(int $userId): ?UserDebt
    {
        return UserDebt::where('user_id', $userId)->first();
    }
}
