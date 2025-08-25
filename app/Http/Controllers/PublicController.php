<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\User;
use App\Services\CommunalService;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected CommunalService $communalService;

    public function __construct(CommunalService $communalService)
    {
        $this->communalService = $communalService;
    }

    public function getAllUsers()
    {
        $users = User::all();
        return ApiResponse::success($users, 'Foydalanuvchilar ro‘yxati');
    }

    // Barcha userlar bo‘yicha communal
    public function getCommunalMonth()
    {
        $data = $this->communalService->getComunalMonthAllUsers();
        return ApiResponse::success($data, 'Barcha foydalanuvchilar uchun kommunal hisob-kitob');
    }

    // Bitta user bo‘yicha communal
    public function getCommunalMonthById(int $user_id)
    {
        $data = $this->communalService->getCommunalMonthById($user_id);
        return ApiResponse::success($data, "Foydalanuvchi #$user_id uchun kommunal hisob-kitob");
    }
}
