<?php

if (!function_exists('bytesToHuman')) {
    /**
     * Преобразовывает переданное число байт в человекочитаемый вид
     *
     * @param $bytes
     *
     * @return string
     */
    function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

if (!function_exists('array2object')) {
    function array2object($x)
    {
        if (!is_array($x)) {
            return $x;
        } elseif (is_numeric(key($x))) {
            return array_map(__FUNCTION__, $x);
        } else {
            return (object)array_map(__FUNCTION__, $x);
        }
    }
}
