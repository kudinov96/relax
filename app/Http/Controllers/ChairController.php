<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use WebToPay;

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
        $this->validateRates($minutes, $costs);

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

    public function redirectToPayment(Chair $chair, int $minutes, int $costs)
    {
        $this->validateRates($minutes, $costs);

        try {
            WebToPay::redirectToPayment([
                'projectid' => config('webtopay.projectid'),
                'sign_password' => config('webtopay.sign_password'),
                'orderid' => 0,
                'amount' => $costs,
                'currency' => 'EUR',
                'country' => 'LT',
                'accepturl' => route("chair.success", ["chair" => $chair, "minutes" => $minutes]),
                'cancelurl' => route("chair.fail.payment", ["chair" => $chair]),
                'callbackurl' => route("chair.callback", ["chair" => $chair, "minutes" => $minutes, "costs" => $costs]),
                'test' => 1,
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function callbackPayment(Request $request, Chair $chair, int $minutes, int $costs)
    {
        Log::debug(print_r($request->all(), true));
    }

    private function validateRates(int $minutes, int $costs)
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
    }
}
