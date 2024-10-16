<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huis extends Model
{
    use HasFactory;

    protected $table = 'huizen'; // Voeg dit toe om de tabelnaam expliciet te maken

    protected $fillable = [
        'straatnaam', 'postcode', 'huisnummer', 'prijs', 'type', 'oppervlakte_huis',
        'oppervlakte_tuin', 'plaats', 'provincie', 'slaapkamers', 'badkamers',
        'woonlagen', 'energie_label', 'isolatie', 'bouwjaar', 'garage',
        'zwembad', 'tuin', 'zonnepanelen',
    ];
}