<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Response;

class LogController extends Controller
{
    public function index(): Response
    {
        $items = Log::latest()->paginate(10);

        return response()->view("logs.index", [
            "items" => $items,
        ]);
    }

    public function show(Log $item)
    {
        return response()->view("logs.show", [
            "item" => $item,
        ]);
    }
}
