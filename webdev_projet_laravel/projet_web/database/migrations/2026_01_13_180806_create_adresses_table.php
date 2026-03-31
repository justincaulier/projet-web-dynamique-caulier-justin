<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('number');
            $table->string('city');
            $table->string('postcode');
            $table->string('country');
            $table->string('box')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adresses');
    }
};
