<?php

namespace App;

class NumberInWords
{
    protected static $words = [
        'minus',
        ['zero', 'jeden', 'dwa', 'trzy', 'cztery', 'pięć', 'sześć', 'siedem', 'osiem', 'dziewięć'],
        ['dziesięć', 'jedenaście', 'dwanaście', 'trzynaście', 'czternaście', 'piętnaście', 'szesnaście', 'siedemnaście', 'osiemnaście', 'dziewiętnaście'],
        ['dziesięć', 'dwadzieścia', 'trzydzieści', 'czterdzieści', 'pięćdziesiąt', 'sześćdziesiąt', 'siedemdziesiąt', 'osiemdziesiąt', 'dziewięćdziesiąt'],
        ['sto', 'dwieście', 'trzysta', 'czterysta', 'pięćset', 'sześćset', 'siedemset', 'osiemset', 'dziewięćset'],
        ['tysiąc', 'tysiące', 'tysięcy'],
        ['milion', 'miliony', 'milionów'],
        ['miliard', 'miliardy', 'miliardów'],
        ['bilion', 'biliony', 'bilionów'],
        ['biliard', 'biliardy', 'biliardów'],
        ['trylion', 'tryliony', 'trylionów'],
        ['tryliard', 'tryliardy', 'tryliardów'],
        ['kwadrylion', 'kwadryliony', 'kwadrylionów'],
        ['kwintylion', 'kwintyliony', 'kwintylionów'],
        ['sekstylion', 'sekstyliony', 'sekstylionów'],
        ['septylion', 'septyliony', 'septylionów'],
        ['oktylion', 'oktyliony', 'oktylionów'],
        ['nonylion', 'nonyliony', 'nonylionów'],
        ['decylion', 'decyliony', 'decylionów']
    ];
 
    public static function integerNumberToWords($int)
    {
        $int = strval($int);
        $in = preg_replace('/[^-\d]+/', '', $int);
 
        $return = '';
 
        if ($in{0} == '-') {
            $in = substr($in, 1);
            $return = self::$words[0] . ' ';
        }
 
        $txt = str_split(strrev($in), 3);
 
        if ($in == 0) {
            $return = self::$words[1][0] . ' ';
        }
 
        for ($i = count($txt) - 1; $i >= 0; $i--) {
            $number = (int) strrev($txt[$i]);
 
            if ($number > 0) {
                if ($i == 0) {
                    $return .= self::number($number) . ' ';
                } else {
                    $return .= ($number > 1 ? self::number($number) . ' ' : '')
                            . self::inflection(self::$words[4 + $i], $number) . ' ';
                }
            }
        }
 
        return self::clear($return);
    }
 
    public static function amountToWords($amount, $currencyName = 'zł', $centName = 'gr')
    {
        if (!is_numeric($amount)) {
            throw new \Exception('Nieprawidłowa kwota');
        }
 
        $amountString = number_format($amount, 2, '.', '');
        list($bigAmount, $smallAmount) = explode('.', $amountString);
 
        $bigAmount = static::integerNumberToWords($bigAmount) . ' ' . $currencyName . ' ';
        $smallAmount = static::integerNumberToWords($smallAmount) . ' ' . $centName;
 
        return self::clear($bigAmount . $smallAmount);
    }
 
    protected static function clear($string)
    {
        return preg_replace('!\s+!', ' ', trim($string));
    }

    protected static function inflection(array $inflections, $int)
    {
        $txt = $inflections[2];
 
        if ($int == 1) {
            $txt = $inflections[0];
        }
 
        $units = intval(substr($int, -1));
 
        $rest = $int % 100;
 
        if (($units > 1 && $units < 5) &! ($rest > 10 && $rest < 20)) {
            $txt = $inflections[1];
        }
 
        return $txt;
    }
 
    protected static function number($int)
    {
        $return = '';
 
        $j = abs(intval($int));
 
        if ($j == 0) {
            return self::$words[1][0];
        }
 
        $units = $j % 10;
        $dozens = intval(($j % 100 - $units) / 10);
        $hundreds = intval(($j - $dozens * 10 - $units) / 100);
 
        if ($hundreds > 0) {
            $return .= self::$words[4][$hundreds - 1] . ' ';
        }
 
        if ($dozens > 0) {
            if ($dozens == 1) {
                $return .= self::$words[2][$units] . ' ';
            } else {
                $return .= self::$words[3][$dozens - 1] . ' ';
            }
        }
 
        if ($units > 0 && $dozens != 1) {
            $return .= self::$words[1][$units] . ' ';
        }
 
        return $return;
    }
}