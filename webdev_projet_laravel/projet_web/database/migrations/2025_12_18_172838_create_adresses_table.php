<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('adresses')){
            Schema::create('adresses', function (Blueprint $table) {
                $table->id();
                $table->string('street');
                $table->integer('number');
                $table->string('city');
                $table->integer('postcode');
                $table->string('country');
                $table->integer('box')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adresses');
    }
};
