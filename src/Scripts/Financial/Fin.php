<?php

namespace Helvetiapps\LiveControls\Scripts\Financial;

class Fin{
    public static function calculateProfit(array $profits_in_cents):int{
        $value = 0;
        foreach($profits_in_cents as $pic){
            $value += $pic;
        }
        return $value;
    }

    public static function calculateExpenses(array $expenses_in_cents):int{
        $value = 0;
        foreach($expenses_in_cents as $eic){
            $value += $eic;
        }
        return $value;
    }

    public static function saldo(int $profit_in_cents, int $expenses_in_cents){
        return $profit_in_cents - $expenses_in_cents;
    }
}