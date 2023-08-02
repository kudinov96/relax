<?php

namespace App\Service;

use App\Models\Chair;
use Illuminate\Support\Facades\Http;

class SofocnApiService
{
    private string $url = "https://isf.sofocn.com/api/";

    public function deviceInfo(Chair $chair)
    {
        return Http::get($this->url . "deviceInfo", [
            "deviceCode" => $chair->device_code,
        ])->json();
    }

    public function sendCommand(Chair $chair, int $time)
    {
        return Http::get($this->url . "sendCommand", [
            "deviceCode" => $chair->device_code,
            "time"       => $time,
        ])->json();
    }
}