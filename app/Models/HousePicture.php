<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousePicture extends Model
{
    use HasFactory;

    protected $fillable = ['house_id', 'picture']; // Add the fields you need

    public function house()
    {
        return $this->belongsTo(House::class); // Define the inverse relationship
    }
}