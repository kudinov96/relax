<?php

namespace App\Http\Controllers;

use App\Models\LogChairStatus;
use Illuminate\Http\Response;

class LogStatusController extends Controller
{
    public function index(): Response
    {
        $items = LogChairStatus::latest()->paginate(10);

        return response()->view("logs-status.index", [
            "items" => $items,
        ]);
    }

    public function show(LogChairStatus $item)
    {
        return response()->view("logs-status.show", [
            "item" => $item,
        ]);
    }
}
