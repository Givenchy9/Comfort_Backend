<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousePicturesTable extends Migration
{
    public function up()
    {
        Schema::create('house_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id')->constrained('huizen')->onDelete('cascade'); // Foreign key to houses
            $table->string('picture'); // Path to the picture
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('house_pictures');
    }
}