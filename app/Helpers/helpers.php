<?php

use Carbon\Carbon;

if (!function_exists('randomString')) {

    /**
     * Generate random string
     *
     * @param integer $length Random string length
     * @param boolean $specialCharts Whether it should contain special characters
     * @param boolean $numbers Whether it should contain numbers
     * @return string $randomString
     */
    function randomString(int $length = 10, bool $specialCharts = false, bool $numbers = false): string
    {
        $characters = ($numbers ? '0123456789' : '') . 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters .= $specialCharts ? '!@#$%^&*-+=' : '';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        if ($specialCharts && !preg_match('/^.{' . $length . ',' . $length . '}$(?=.*\d)|(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $randomString)) {
            $randomString = randomString($length, $specialCharts);
        }
        return $randomString;
    }
}

if (!function_exists('dateToHuman')) {

    /**
     * Human Readable Date
     *
     * @param string $date
     * @param bool $hour date is a datetime
     * @return string result format date
     */
    function dateToHuman(string $date, bool $hour = false): string
    {
        $date = new Carbon($date);
        $format = $hour ? 'M j, Y g:i A' : 'M j, Y';
        return str($date->translatedFormat($format))->ucfirst()->__toString();
    }
}

if (!function_exists('toObject')) {
    /**
     * Cast array to object
     *
     * @param array $array the array you want to cast
     * @return object
     */
    function toObject(array $array): object
    {
        return json_decode(json_encode($array));
    }
}

if (!function_exists('formatAmount')) {

    /**
     * Format the amount
     *
     * @param mixed $amount the amount to be formatted
     * @return string|int
     */
    function formatAmount(mixed $amount): string|int
    {
        if (is_numeric($amount)) {
            $value = number_format($amount, 8, '.', ',');
            $checkZero = explode('.', $value);
            return (int)$checkZero[1] > 0 ? $checkZero[0] . '.' . (int)rtrim($checkZero[1], 0) : $checkZero[0];
        }
        return 0;
    }
}

if (!function_exists('capitalize')) {

    /**
     * Format the string capitalize
     *
     * @param string $string the string to be formatted
     * @return string|int
     */
    function capitalize(string $string): string
    {
        return str($string)->lower()->ucfirst()->__toString();
    }
}
