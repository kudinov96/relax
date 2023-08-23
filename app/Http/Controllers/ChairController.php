<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use App\Models\Order;
use App\Service\ChairService;

class ChairController extends Controller
{
    public function show(string $deviceId, ChairService $chairService)
    {
        $chair  = $this->getChair($deviceId);

        if (!$chair) {
            abort(404);
        }

        $status = $chairService->getStatus($chair);

        return view("front.chair.show", [
            "chair"  => $chair,
            "status" => $status,
        ]);
    }

    public function ready(string $deviceId, int $minutes, int $costs)
    {
        $chair  = $this->getChair($deviceId);

        if (!$chair->validateRates($minutes, $costs)) {
            abort(404);
        }

        return view("front.chair.ready", [
            "chair"   => $chair,
            "minutes" => $minutes,
            "costs"   => $costs,
        ]);
    }

    public function success(string $deviceId, int $minutes)
    {
        $chair  = $this->getChair($deviceId);

        return view("front.chair.success", [
            "chair"   => $chair,
            "minutes" => $minutes,
        ]);
    }

    public function failPayment(string $deviceId)
    {
        $chair = $this->getChair($deviceId);

        return view("front.chair.fail.payment", [
            "chair" => $chair,
        ]);
    }

    public function failChair(Order $order)
    {
        // Защита от умников, которые захотят бесконечно запускать кресло
        if ($order->success_run_chair) {
            abort(404);
        }

        return view("front.chair.fail.chair", [
            "chair" => $order->chair,
            "order" => $order,
        ]);
    }

    private function getChair(string $deviceId)
    {
        return Chair::query()->findByDeviceId($deviceId)->first();
    }
}
