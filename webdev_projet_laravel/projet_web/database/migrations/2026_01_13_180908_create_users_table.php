<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\UserRole;

return new class extends Migration
{
    public function up(): void
    {

            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('surname')->nullable();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password')->nullable();
                $table->string('provider')->nullable();
                $table->string('provider_id')->nullable();
                $table->string('avatar')->nullable();
                $table->text('description')->nullable();
                $table->foreignId('address_id')
                    ->nullable()
                    ->constrained('adresses')
                    ->cascadeOnDelete();

                $table->string('tva', 20)->nullable();
                $table->string('telephone')->nullable();
                $table->unsignedInteger('login_attempts')->default(0);
                $table->string('language')->default('fr');
                $table->string('website')->nullable();
                $table->string('role')->default(UserRole::USER->value);
                $table->date('registered_at')->default(now());
                $table->boolean('is_banned')->default(false);
                $table->boolean('registration_confirmed')->default(false);
                $table->boolean('newsletter')->default(false);

                $table->rememberToken();
                $table->timestamps();
            });
        }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
