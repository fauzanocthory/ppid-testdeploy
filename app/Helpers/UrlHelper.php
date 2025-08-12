<?php

if (!function_exists('format_url')) {
    function format_url($url)
    {
        if (!$url) {
            return null;
        }

        // Kalau belum ada http:// atau https://, tambahkan https://
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'https://' . $url;
        }

        return $url;
    }
}
