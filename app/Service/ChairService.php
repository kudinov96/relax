<?php

namespace App\Service;

use App\Models\Chair;
use App\Models\LogChair;
use App\Models\LogChairStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class ChairService
{
    private ChairApiService $chairApiService;

    public function __construct()
    {
        $this->chairApiService = app(ChairApiService::class);
    }

    public function getStatus(Chair $chair, Request $request): ?int
    {
        try {
            $deviceInfo = $this->chairApiService->deviceInfo(
                deviceCode: $chair->device_code,
            );

            if (!isset($deviceInfo["data"][0]["status"])) {
                LogChairStatus::query()->create([
                    "chair_id" => $chair->id,
                    "message"  => $deviceInfo,
                    "ip"       => $request->getClientIp() ?? null,
                ]);

                return null;
            }

            return $deviceInfo["data"][0]["status"];
        } catch (\Exception $e) {
            LogChairStatus::query()->create([
                "chair_id" => $chair->id,
                "message"  => $e->getCode() . " | " . $e->getFile() . " | " .  $e->getMessage(),
                "ip"       => $request->getClientIp() ?? null,
            ]);

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
