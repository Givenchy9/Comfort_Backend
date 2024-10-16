<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('huizen', function (Blueprint $table) {
            $table->id();
            $table->string('straatnaam');
            $table->string('postcode');
            $table->string('huisnummer');
            $table->decimal('prijs', 10, 2);
            $table->enum('type', ['koop', 'huur']);
            $table->integer('oppervlakte_huis');
            $table->integer('oppervlakte_tuin')->nullable();
            $table->string('plaats');
            $table->string('provincie');
            $table->integer('slaapkamers');
            $table->integer('badkamers');
            $table->integer('woonlagen');
            $table->string('energie_label');
            $table->string('isolatie')->nullable();
            $table->year('bouwjaar');
            $table->enum('garage', ['ja', 'nee']);
            $table->enum('zwembad', ['ja', 'nee']);
            $table->enum('tuin', ['ja', 'nee']);
            $table->enum('zonnepanelen', ['ja', 'nee']);
            $table->timestamps();
        });
    }

    

    public function down()
    {
        Schema::dropIfExists('huizen');
    }

};
