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
        Schema::create('user_personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('PK: users.id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('id_number')->index('idx_id_number');
            $table->string('id_type')->index('idx_id_type');
            $table->string('current_level');
            $table->string('funding_level');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('ethnicity');
            $table->string('marital_status');
            $table->string('employment_details')->nullable();
            $table->integer('annual_income')->nullable();
            $table->string('proof_of_income')->nullable();
            $table->string('affadavit_orphan')->nullable();
            $table->string('disability')->nullable();
            $table->integer('disability_count')->nullable();
            $table->json('disabilities')->nullable();
            $table->string('nsfas_history');
            $table->string('nsfas_student')->nullable();
            $table->string('nsfas_registration_number')->nullable();
            $table->string('id_copy');
            $table->string('back_id_copy')->nullable();
            $table->integer('combined_income')->nullable()->index('idx_combined_income');
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
        Schema::dropIfExists('user_personal_information');
    }
};
