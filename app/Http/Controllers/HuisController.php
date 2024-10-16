<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Huis;
use Illuminate\Http\Request;

class HuisController extends Controller
{
    public function huizen()
    {
        // Haal alle huizen op
        $huizen = Huis::all();
        // Return de huizen als JSON-response
        return response()->json($huizen);
    }
}