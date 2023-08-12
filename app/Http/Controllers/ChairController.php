<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use Illuminate\Http\Request;

class ChairController extends Controller
{
    public function show(Chair $chair)
    {
        return view("front.chair.show", [
            "chair" => $chair,
        ]);
    }

    public function ready(Chair $chair, int $minutes, int $costs)
    {
        $rates = [
            10 => 5,
            15 => 7,
            20 => 9,
            30 => 11,
        ];

        if (!isset($rates[$minutes]) || $rates[$minutes] !== $costs) {
            abort(404);
        }

        $paymentLink = null;

        return view("front.chair.ready", [
            "chair"       => $chair,
            "paymentLink" => $paymentLink,
        ]);
    }

    public function success(Chair $chair, int $minutes)
    {
        return view("front.chair.success", [
            "chair"   => $chair,
            "minutes" => $minutes,
        ]);
    }

    public function failPayment(Chair $chair)
    {
        return view("front.chair.fail.payment", [
            "chair" => $chair,
        ]);
    }

    public function failChair(Chair $chair)
    {
        // Тут нужен какой-нибудь токен, так как это уязвимость
        // Кто-то может зайти на эту страницу и сидеть в кресле сколько угодно

        if ($chair->status === 3) {
            abort(404);
        }

        return view("front.chair.fail.chair", [
            "chair" => $chair,
        ]);
    }
}
