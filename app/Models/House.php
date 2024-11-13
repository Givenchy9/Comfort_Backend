<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'huizen';

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

    // Add this relationship
    public function pictures()
    {
        return $this->hasMany(HousePicture::class); // This assumes the new `house_pictures` table will be created
    }
}