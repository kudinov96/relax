<?php

use Illuminate\Support\Facades\Cache;

if (!function_exists("timeZoneList")) {
    function timeZoneList() {
        return Cache::rememberForever('timezones_list_collection', function () {
            $timestamp = time();
            foreach (timezone_identifiers_list(\DateTimeZone::ALL) as $value) {
                date_default_timezone_set($value);
                $timezone[$value] = $value . ' (GMT ' . date('P', $timestamp) . ')';
            }
            return collect($timezone)->sortKeys();
        });
    }
}

