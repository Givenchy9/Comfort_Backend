<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    // Specify the table name explicitly
    protected $table = 'Huizen';

    // Optional: Add fillable fields if you use mass assignment
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
        'picture',
    ];

    public function pictures()
    {
        return $this->hasMany(HousePicture::class); // For multiple pictures
    }
}