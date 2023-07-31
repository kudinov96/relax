<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimezoneController extends Controller
{
    public function update(Request $request)
    {
        $request->user()->update([
            'timezone' => $request->timezone,
        ]);

        return back()->with('status', 'timezone-updated');
    }
}
