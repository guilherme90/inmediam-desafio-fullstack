<?php

namespace App\Traits;

trait CalculateBalanceTrait
{
    public function getOutstandingBalance(float $price): float
    {
        $daysOfMonth = (int) date('t');

        $pricePerDay = floor(($price / $daysOfMonth) * 100) / 100;
        $countDays = abs((int) date('d', strtotime(' +1 day')) - $daysOfMonth);

        return $countDays * $pricePerDay;
    }
}
