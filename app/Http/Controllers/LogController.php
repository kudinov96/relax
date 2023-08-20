<?php

namespace App\Http\Controllers;

use App\Models\LogChair;
use Illuminate\Http\Response;

class LogController extends Controller
{
    public function index(): Response
    {
        $items = LogChair::latest()->paginate(10);

        return response()->view("logs.index", [
            "items" => $items,
        ]);
    }

    public function show(LogChair $item)
    {
        return response()->view("logs.show", [
            "item" => $item,
        ]);
    }
}
