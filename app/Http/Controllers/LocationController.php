<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function cities(Province $province): JsonResponse
    {
        return response()->json(
            $province->cities()->get(['id', 'name'])
        );
    }
}
