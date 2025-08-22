<?php

namespace App\Services;

use App\Models\IssiqSuv;

class IssiqSuvService
{
    public function create(array $data)
    {
        return IssiqSuv::create($data);
    }


    public function getById(int $userId): ?IssiqSuv
    {
        return IssiqSuv::where('user_id', $userId)->first();
    }
}
