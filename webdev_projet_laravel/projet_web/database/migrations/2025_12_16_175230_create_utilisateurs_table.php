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
            Schema::table('users', function (Blueprint $table) {
                $table->string('prenom');
                $table->string('adresse');
                $table->integer('tva');
                $table->integer('telephone mobile');
                $table->integer('nombre tentatives connexion');
                $table->string('langue');
                $table->string('site web')->nullable();
                $table->string('rôle');
                $table->date('date inscription');
                $table->boolean('est banni');
                $table->boolean('inscription confirmation');
                $table->boolean('newsletter');
            });
        }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
