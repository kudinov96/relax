<?php

namespace App\Service;

use App\Models\Chair;
use Illuminate\Support\Facades\Http;

class ChairApiService
{
    const URL = "https://isf.sofocn.com/api/";

    public function deviceInfo(string $deviceCode)
    {
        return Http::get(self::URL . "deviceInfo", [
            "deviceCode" => $deviceCode,
        ])->json();
    }

    public function sendCommand(string $deviceCode, int $time)
    {
        return Http::get(self::URL . "sendCommand", [
            "deviceCode" => $deviceCode,
            "time"       => $time,
        ])->json();
    }
}