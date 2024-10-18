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

    public function show($id)
    {
        // Haal het specifieke huis op op basis van het ID
        $huis = Huis::find($id);

        // Controleer of het huis bestaat
        if (!$huis) {
            return response()->json(['message' => 'Huis niet gevonden'], 404);
        }

        // Return het specifieke huis als JSON-response
        return response()->json($huis);
    }

}