<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use App\Models\Order;
use App\Service\ChairService;
use Illuminate\Http\Request;
use WebToPay;

class PaymentController extends Controller
{
    public function paymentRedirect(string $deviceId, int $minutes, int $costs)
    {
        $chair = Chair::query()->findByDeviceId($deviceId)->first();

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
                'amount' => $costs . '00',
                'currency' => 'EUR',
                'country' => 'LV',
                'lang' => 'LAV', // RUS
                'accepturl' => route("payment.accept", ["order" => $order,]),
                'cancelurl' => route("chair.fail.payment", ["deviceId" => $chair->device_id]),
                'callbackurl' => route("payment.callback", ["order" => $order]),
                'test' => config("payment.test_mode"),
            ]);
        } catch (\Exception $e) {
            $order->update([
                "response" => $e->getMessage(),
            ]);
        }
    }

    public function paymentAccept(Order $order, ChairService $chairService)
    {
        if (!$chairService->runChair($order, $order->minutes)) {
            return response()->redirectToRoute("chair.fail.chair", ["order" => $order]);
        }

        return response()->redirectToRoute("chair.success", ["deviceId" => $order->chair->device_id, "minutes" => $order->minutes]);
    }

    public function callbackPayment(Request $request, Order $order)
    {
        $order->update([
            "response" => $request->all(),
        ]);
    }
}