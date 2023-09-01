<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(): Response
    {
        $items = Order::latest()->paginate(50);

        return response()->view("orders.index", [
            "items" => $items,
        ]);
    }

    public function show(Order $item)
    {
        return response()->view("orders.show", [
            "item" => $item,
        ]);
    }
}
