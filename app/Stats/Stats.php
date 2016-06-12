<?php namespace maze\Stats;

abstract class Stats
{

    protected function thousandsFormat($number, $precision = 2, $divisors = null)
    {
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '',
                pow(1000, 1) => 'K',
                pow(1000, 2) => 'M',
                pow(1000, 3) => 'B',
                pow(1000, 4) => 'T',
                pow(1000, 5) => 'Qa',
                pow(1000, 6) => 'Qi',
            );
        }
        foreach ($divisors as $divisor => $shorthand) {
            if ($number < ($divisor * 1000)) {
                break;
            }
        }

        return number_format($number / $divisor, $precision) + 0 . $shorthand;
    }
}
