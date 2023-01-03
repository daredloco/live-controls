<?php

namespace Helvetiapps\LiveControls\Utils;
class Utils
{
    /**
     * Counts the amount of numbers inside a number
     * From: https://stackoverflow.com/a/28434327
     *
     * @param integer $num
     * @return void
     */
    public static function countNumber(int $num): int
    {
        return $num !== 0 ? floor(log10($num) + 1) : 1;
    }


    public static function int2Day(int $val, bool $useLong = false): string
    {
        if($useLong)
        {
            return __('Day_Long_'.$val);
        }
        return __('Day_'.$val);
    }

    /**
     * Calculates the days between $fromDay and $toDay over a specific month
     *
     * @param integer $fromDay The weekday the calculation should start (0 is sunday)
     * @param integer $toDay The weekday the calculation should end (0 is sunday)
     * @param integer $month The month of the year the calculation should take place in
     * @param integer $year The year the calculation should take place in
     * @return int The amount of days used with this setting
     */
    public static function calculateDaysInMonth(int $fromDay, int $toDay, int $month, int $year): int
    {
        $days = 0;

        $lastday = date("t", mktime(0,0,0,$month,1,$year));
        for($i = 1; $i <= $lastday; $i++)
        {
            if($lastday >= $i)
            {
                $weekday = date("w", mktime(0,0,0,$month, $i, $year));
                if($weekday <= $toDay && $weekday >= $fromDay){
                    $days++;
                }
            }
        }
        return $days;
    }

    /**
     * Transforms the number in cents to its textform. Needs NumberFormatter for it to work!
     *
     * @param integer $numberInCents
     * @return string A text representation of the number
     */
    public static function number2Text(int $numberInCents, string $locale = 'pt_BR'): string
    {
        $number = $numberInCents / 100;
        if (!is_numeric($number)) {
            return false;
        }
        $numero_extenso = '';
        $arr = explode(".", $number);
        $inteiro = $arr[0];
        if (isset($arr[1])) {
            $decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
        }

        //TODO: Check if numberformatter is loaded before tryiung to access it
        $fmt = new \NumberFormatter($locale, \NumberFormatter::SPELLOUT);
        if (is_array($arr)) {
            $numero_extenso = $fmt->format($inteiro) . ' reais';
            if (isset($decimos) && $decimos > 0) {
                $numero_extenso .= ' e ' . $fmt->format($decimos) . ' centavos';
            }
        }
        return $numero_extenso;
    }
}