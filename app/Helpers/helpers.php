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

if (!function_exists("otherLangs")) {
    function otherLangs() {
        $langs = [
            "lv",
            "ru",
            "en",
        ];

        unset($langs[array_search(app()->getLocale(), $langs)]);

        return $langs;
    }
}

if (!function_exists("moreLink")) {
    function moreLink() {
        $langs = [
            "lv" => "https://relaxtime.lv/",
            "ru" => "https://relaxtime.lv/ru/",
            "en" => "https://relaxtime.lv/en/",
        ];

        return $langs[app()->getLocale()];
    }
}

if (!function_exists("policyLink")) {
    function policyLink() {
        $langs = [
            "lv" => "https://relaxtime.lv/masazas-kresla-lietosanas-noteikumi/",
            "ru" => "https://relaxtime.lv/ru/pravila-ispolzovaniya-massazhnogo-kresla/",
            "en" => "https://relaxtime.lv/en/massage-chair-usage-rules/",
        ];

        return $langs[app()->getLocale()];
    }
}
