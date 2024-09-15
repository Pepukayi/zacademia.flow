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
        Schema::create('user_school_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('PK: users.id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('high_school');
            $table->string('high_school_level');
            $table->string('curriculum');
            $table->integer('subject_count');
            $table->json('subjects');
            $table->string('latest_results');
            $table->string('average_results')->nullable();
            $table->string('high_school_graduate');
            $table->integer('high_school_graduation_year');
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
        Schema::dropIfExists('user_school_information');
    }
};
