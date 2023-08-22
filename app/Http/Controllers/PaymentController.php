<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use App\Models\Order;
use App\Service\ChairService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use WebToPay;

class PaymentController extends Controller
{
    public function redirectPayment(Chair $chair, int $minutes, int $costs)
    {
        if (!$chair->validateRates($minutes, $costs)) {
            abort(404);
        }

        $order = Order::query()->create([
            "chair_id" => $chair->id,
            "minutes"  => $minutes,
            "costs"    => $costs,
        ]);

        try {
            WebToPay::redirectToPayment([
                'projectid' => config('webtopay.projectid'),
                'sign_password' => config('webtopay.sign_password'),
                'orderid' => $order->id,
                'amount' => $costs,
                'currency' => 'EUR',
                'country' => 'LT',
                'accepturl' => route("payment.accept", ["order" => $order,]),
                'cancelurl' => route("chair.fail.payment", ["chair" => $chair]),
                'callbackurl' => route("payment.callback", ["order" => $order]),
                'test' => config("payment.test_mode"),
            ]);
        } catch (\Exception $e) {
            $order->update([
                "response" => $e->getMessage(),
            ]);
        }
    }

    public function paymentAccept(Request $request, Order $order, ChairService $chairService)
    {
        Log::debug(print_r($request->all(), true));

        if (!$chairService->runChair($order, $order->minutes)) {
            return response()->redirectToRoute("chair.fail.chair", ["order" => $order]);
        }

        return response()->redirectToRoute("chair.success", ["chair" => $order->chair, "minutes" => $order->minutes]);
    }

    public function callbackPayment(Request $request, Order $order)
    {
        $order->update([
            "response" => $request->all(),
        ]);
    }
}