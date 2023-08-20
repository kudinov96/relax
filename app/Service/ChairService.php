<?php

namespace App\Service;

use App\Models\Chair;
use App\Models\LogChair;

class ChairService
{
    private ChairApiService $chairApiService;

    public function __construct()
    {
        $this->chairApiService = app(ChairApiService::class);
    }

    public function getStatus(Chair $chair): ?int
    {
        try {
            $deviceInfo = $this->chairApiService->deviceInfo(
                deviceCode: $chair->device_code,
            );

            return isset($deviceInfo["data"][0]["status"]) ? $deviceInfo["data"][0]["status"] : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function runChair(Chair $chair, int $minutes): bool
    {
        $deviceCode = $chair->device_code;
        $time       = $minutes;
        $request    = ChairApiService::URL . "sendCommand?deviceCode=$deviceCode&time=$time";

        try {
            $response = $this->chairApiService->sendCommand(
                deviceCode: $deviceCode,
                time:       $time,
            );

            LogChair::query()->create([
                "chair_id" => $chair->id,
                "request"  => $request,
                "response" => $response,
            ]);

            return true;
        } catch (\Exception $e) {
            LogChair::query()->create([
                "chair_id" => $chair->id,
                "request"  => $request,
                "response" => $e->getMessage(),
            ]);

            return false;
        }
    }
}