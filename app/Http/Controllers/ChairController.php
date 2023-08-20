<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use App\Models\Order;
use App\Service\ChairService;

class ChairController extends Controller
{
    public function show(Chair $chair, ChairService $chairService)
    {
        $status = $chairService->getStatus($chair);

        return view("front.chair.show", [
            "chair"  => $chair,
            "status" => $status,
        ]);
    }

    public function ready(Chair $chair, int $minutes, int $costs)
    {
        $chair->validateRates($minutes, $costs);

        return view("front.chair.ready", [
            "chair"   => $chair,
            "minutes" => $minutes,
            "costs"   => $costs,
        ]);
    }

    public function success(Chair $chair, int $minutes)
    {
        return view("front.chair.success", [
            "chair"   => $chair,
            "minutes" => $minutes,
        ]);
    }

    public function failPayment(Order $order)
    {
        return view("front.chair.fail.payment", [
            "chair" => $order->chair,
        ]);
    }

    public function failChair(Order $order, ChairService $chairService)
    {
        // Тут нужен какой-нибудь токен, так как это уязвимость
        // Кто-то может зайти на эту страницу и сидеть в кресле сколько угодно

        //$status = $chairService->getStatus($order->chair);

        //if ($status === null) {
            // Тут нужно выводить страницу, когда получение статус кресла невозможно
        //}

        //if ($status === 3) {
            //abort(404);
        //}

        return view("front.chair.fail.chair", [
            "chair" => $order->chair,
        ]);
    }
}
