<?php

use App\Models\Aplikasi;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        static $data;

        if (!$data) {
            $data = Aplikasi::first();
        }

        return $data->$key ?? $default;
    }
}