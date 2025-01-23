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
        (float)$kelembapan = $request['kelembapan'];
        (float)$status_kipas = $request['status_kipas'];
        (float)$status_mist_maker = $request['status_mist_maker'];

        $post = Monitoring::create([
            'suhu' => $suhu,
            'kelembapan' => $kelembapan,
            'status_kipas' => $status_kipas,
            'status_mist_maker' => $status_mist_maker,
        ]);

        return response()->json('success');
    }
}