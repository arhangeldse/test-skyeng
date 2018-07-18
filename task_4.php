<?php

/**
 * @param string $number
 * @param string $number2
 * @return string
 */
function addition_long_numbers($number, $number2) {
    $length = max(strlen($number), strlen($number2));
    $format = "%0" . $length . "s";
    $number = sprintf($format, $number);
    $number2 = sprintf($format, $number2);

    $numberChars = array_reverse(str_split($number));
    $number2Chars = array_reverse(str_split($number2));

    $totalChars = [];

    $transfer = 0;
    for ($i = 0; $i < $length; $i++) {
        $sum = intval($numberChars[$i]) + intval($number2Chars[$i]) + $transfer;
        $transfer = 0;
        if ($sum > 10) {
            $transfer = 1;
            $sum = $sum - 10;
        }
        $totalChars[$i] = strval($sum);
    }

    if ($transfer) {
        $totalChars[$i] = strval($transfer);
    }

    $totalNumber = implode(array_reverse($totalChars));

    return $totalNumber;
}