<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function api_show()
    {
        $monitoring = Monitoring::orderBy('created_at', 'desc')->take(10)->get()->map(function ($item) {
            // Format the created_at field using Carbon
            $item->formatted_created_at = $item->created_at->format('Y-m-d H:i:s');

            return $item;
        });
        return response()->json($monitoring);
    }
    public function show()
    {
        $monitoring = Monitoring::orderBy('created_at', 'desc')->get();

        return view('home', ['monitoring' => $monitoring]);
        // return response()->json($monitoring);
    }

    public function insert(Request $request)
    {
        (float)$suhu = $request['suhu'];

        $post = Monitoring::create([
            'suhu' => $suhu,
        ]);

        return response()->json('success');
    }
}