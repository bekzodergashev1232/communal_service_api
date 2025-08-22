<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CommunalService;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected $communalService;

    public function __construct(CommunalService $communalService)
    {
        $this->communalService = $communalService;
    }
    public function getAllUsers(Request $request){
        return User::all();
    }

    //communal lar uchun
    public function getCommunalMonth()
    {
        return response()->json($this->communalService->getComunalMonthAllUsers());
    }

    public function getCommunalMonthById(int $user_id)
    {
        return response()->json($this->communalService->getCommunalMonthById($user_id));
    }

}
