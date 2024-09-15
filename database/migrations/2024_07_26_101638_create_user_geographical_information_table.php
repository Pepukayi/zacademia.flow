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
        Schema::create('user_geographical_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('PK: users.id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('country_residence')->index('idx_country_residence');
            $table->string('country_citizenship')->index('idx_country_citizenship');
            $table->string('street_address');
            $table->string('suburb');
            $table->string('city');
            $table->string('state_province')->index('idx_state_province');
            $table->string('country');
            $table->string('zip_postal_code');
            $table->string('proof_of_address');
            $table->timestamps();
            $table->index(['created_at', 'updated_at']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_geographical_information');
    }
};
