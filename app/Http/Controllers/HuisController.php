<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HuisController extends Controller
{
    public function huizen()
    {
        // Include the pictures relationship for all houses
        $huizen = House::with('pictures')->get();

        return response()->json($huizen);
    }


    public function show($id)
    {
        // Include the pictures relationship using "with"
        $huis = House::with('pictures')->find($id);

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

    public function delete($id)
    {
        $huis = House::find($id);

        if (!$huis) {
            return response()->json(['message' => 'Huis niet gevonden'], 404);
        }

        $huis->delete();

        return response()->json(['message' => 'Huis succesvol verwijderd'], 200);
    }

    public function createpicture(Request $request, $id)
    {
        $validated = $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the uploaded image
        ]);

        // Find the existing house by ID
        $huis = House::find($id);

        if (!$huis) {
            return response()->json(['message' => 'Huis niet gevonden'], 404);
        }

        // Handle the picture upload
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('houses', 'public'); // Store picture in public/houses directory

            // Save the picture in the house_pictures table
            $huis->pictures()->create(['picture' => $picturePath]); // Assuming a pictures relationship exists
        }

        return response()->json([
            'message' => 'Picture added successfully to the house',
            'huis' => $huis->load('pictures'), // Include pictures in the response
        ]);
    }


    public function createpictures(Request $request)
    {
        $validated = $request->validate([
            // other validations
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate pictures
        ]);

        $huis = House::create($validated);

        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $picturePath = $picture->store('houses', 'public');
                $huis->pictures()->create(['picture' => $picturePath]);
            }
        }

        return response()->json([
            'message' => 'House created successfully',
            'huis' => $huis->load('pictures'),
        ], 201);
    }

}