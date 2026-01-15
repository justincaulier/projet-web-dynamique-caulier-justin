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
        if(!Schema::hasTable('stages')){
            Schema::create('stages', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->longText('description');
                $table->date('date_start');
                $table->date('date_end');
                $table->date('date_publication_start');
                $table->date('date_publication_end');
                $table->integer('price');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->longText('informations_complementary');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
