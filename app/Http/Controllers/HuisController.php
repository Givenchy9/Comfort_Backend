<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HuisController extends Controller
{
    public function huizen()
    {

        $huizen = House::all();

        return response()->json($huizen);
    }

    public function show($id)
    {
        $huis = Huis::find($id);

        if (!$huis) {
            return response()->json(['message' => 'Huis niet gevonden'], 404);
        }

        return response()->json($huis);
    }
    
    public function create(Request $request)
    {
        $validated = $request->validate([
            'straatnaam' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'huisnummer' => 'required|integer',
            'prijs' => 'required|numeric',
            'type' => 'required|string|in:koop,huur',
            'oppervlakte_huis' => 'required|integer|min:50|max:300',
            'oppervlakte_tuin' => 'nullable|integer|min:10|max:150',
            'plaats' => 'required|string|max:255',
            'provincie' => 'required|string|max:255',
            'slaapkamers' => 'required|integer|min:1|max:6',
            'badkamers' => 'required|integer|min:1|max:3',
            'woonlagen' => 'required|integer|min:1|max:3',
            'energie_label' => 'required|string|in:A,B,C,D',
            'isolatie' => 'required|string|in:Volledig geïsoleerd,Gedeeltelijk geïsoleerd,Geen',
            'bouwjaar' => 'required|integer',
            'garage' => 'required|string|in:ja,nee',
            'zwembad' => 'required|string|in:ja,nee',
            'tuin' => 'required|string|in:ja,nee',
            'zonnepanelen' => 'required|string|in:ja,nee',
        ]);

        $huizen = House::create($validated);

        return response()->json([
            'message' => 'House created successfully',
            'huis' => $huizen,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $huis = House::find($id);

        if (!$huis) {
            return response()->json(['message' => 'Huis niet gevonden'], 404);
        }

        $validated = $request->validate([
            'straatnaam' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'huisnummer' => 'required|integer',
            'prijs' => 'required|numeric',
            'type' => 'required|string|in:koop,huur',
            'oppervlakte_huis' => 'required|integer|min:50|max:300',
            'oppervlakte_tuin' => 'nullable|integer|min:10|max:150',
            'plaats' => 'required|string|max:255',
            'provincie' => 'required|string|max:255',
            'slaapkamers' => 'required|integer|min:1|max:6',
            'badkamers' => 'required|integer|min:1|max:3',
            'woonlagen' => 'required|integer|min:1|max:3',
            'energie_label' => 'required|string|in:A,B,C,D',
            'isolatie' => 'required|string|in:Volledig geïsoleerd,Gedeeltelijk geïsoleerd,Geen',
            'bouwjaar' => 'required|integer',
            'garage' => 'required|string|in:ja,nee',
            'zwembad' => 'required|string|in:ja,nee',
            'tuin' => 'required|string|in:ja,nee',
            'zonnepanelen' => 'required|string|in:ja,nee',
        ]);

        $huis->update($validated);

        return response()->json([
            'message' => 'Huis bijgewerkt',
            'huis' => $huis,
        ], 200);
    }
}