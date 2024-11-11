<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    // Voeg optioneel fillable-velden toe als je die gebruikt
    protected $fillable = [
        'straatnaam',
        'postcode',
        'huisnummer',
        'prijs',
        'type',
        'oppervlakte_huis',
        'oppervlakte_tuin',
        'plaats',
        'provincie',
        'slaapkamers',
        'badkamers',
        'woonlagen',
        'energie_label',
        'isolatie',
        'bouwjaar',
        'garage',
        'zwembad',
        'tuin',
        'zonnepanelen',
    ];
}
