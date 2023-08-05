<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use Illuminate\Http\Request;

class ChairController extends Controller
{
    public function show(Chair $chair)
    {
        $chair = Chair::first();

        return view("front.chair", [
            "chair" => $chair,
        ]);
    }
}
