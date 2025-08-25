<?php

namespace App\Services;

use App\Models\IssiqSuv;
use App\Models\User;
use App\Models\UserDebt;

class CommunalService
{


    public function getCommunalMonthById(int $user_id): array
    {
        $user = User::findOrFail($user_id);

        // qarzdorlik
        $debt = UserDebt::where('user_id', $user->id)->value('debt_amount') ?? 0;

        // issiq suv
        $suv = IssiqSuv::where('user_id', $user->id)->first();
        $total_payment_suv = 0;
        $is_counter_text = 'Maʼlumot yo‘q';

        if ($suv) {
            $total_payment_suv = $suv->is_counter
                ? $suv->water_counter * $suv->price
                : (22000 * 22 / 31) * $user->count_family_member * $suv->water_counter;

            $is_counter_text = $suv->is_counter
                ? 'Suv hisoblagich bor'
                : 'Suv hisoblagich yo‘q';
        }
        $days = now()->day;

        // isitish
        $total_payment_heating = $days * 480 * $user->count_family_member;

        // umumiy
        $total_payment = $total_payment_suv + $total_payment_heating + $debt;

        return [
            'FullName'              => $user->name,
            'Is_counter'            => $is_counter_text, //  qo‘shildi
            'Debt'                  => $debt,
            'Total_payment_suv'     => $total_payment_suv,
            'Total_payment_heating' => $total_payment_heating,
            'FromTo'                => now()->startOfMonth()->format('d.m.Y') . ' to ' . now()->format('d.m.Y'),
            'Total_payment'         => $total_payment,
        ];
    }

    public function getComunalMonthAllUsers(): array
    {
        return User::all()->map(function ($user) {
            return $this->getCommunalMonthById($user->id);
        })->toArray();
    }

    /*  public function getCommunalMonthById(int $user_id): array
      {
          $user = User::findOrFail($user_id);

          // qarzdorlik
          $debt = UserDebt::where('user_id', $user->id)->value('debt_amount') ?? 0;

          // issiq suv
          $suv = IssiqSuv::where('user_id', $user->id)->first();
          $total_payment_suv = 0;

          if ($suv) {
              $total_payment_suv = $suv->is_counter
                  ? $suv->water_counter * $suv->price
                  : (22000 * 22 / 31) * $user->count_family_member * $suv->water_counter;
          }

          // isitish
          $total_payment_heating = 22 * 480 * $user->count_family_member;

          // umumiy
          $total_payment = $total_payment_suv + $total_payment_heating + $debt;

          return [
              'FullName'             => $user->name,
              'Debt'                 => $debt,
              'Total_payment_suv'    => $total_payment_suv,
              'Total_payment_heating'=> $total_payment_heating,
              'FromTo'               => now()->startOfMonth()->format('d.m.Y') . ' to ' . now()->format('d.m.Y'),
              'Total_payment'        => $total_payment,
          ];
      }*/


}
