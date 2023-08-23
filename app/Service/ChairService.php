<?php

namespace App\Service;

use App\Models\Chair;
use App\Models\LogChair;
use App\Models\Order;

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

    public function runChair(Order $order, int $minutes): bool
    {
        $deviceCode = $order->chair->device_code;
        $time       = $minutes;
        $request    = ChairApiService::URL . "sendCommand?deviceCode=$deviceCode&time=$time";

        try {
            $response = $this->chairApiService->sendCommand(
                deviceCode: $deviceCode,
                time:       $time,
            );

            LogChair::query()->create([
                "chair_id" => $order->chair->id,
                "order_id" => $order->id,
                "request"  => $request,
                "response" => $response,
            ]);

            $order->update([
                "success_run_chair" => true,
            ]);

            return true;
        } catch (\Exception $e) {
            LogChair::query()->create([
                "chair_id" => $order->chair->id,
                "order_id" => $order->id,
                "request"  => $request,
                "response" => $e->getMessage(),
            ]);

            return false;
        }
    }
}