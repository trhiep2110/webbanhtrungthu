<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GhnController extends Controller
{
    public function provinces()
    {
        $res = Http::withHeaders([
            'Token' => config('ghn.token'),
        ])->get(config('ghn.api_url') . '/master-data/province');

        return response()->json($res->json());
    }

    public function districts(Request $request)
    {
        $res = Http::withHeaders([
            'Token' => config('ghn.token'),
        ])->get(config('ghn.api_url') . '/master-data/district', [
            'province_id' => $request->province_id,
        ]);

        return response()->json($res->json());
    }

    public function wards(Request $request)
    {
        $res = Http::withHeaders([
            'Token' => config('ghn.token'),
        ])->get(config('ghn.api_url') . '/master-data/ward', [
            'district_id' => $request->district_id,
        ]);

        return response()->json($res->json());
    }
}