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
        Schema::create('user_spousal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('PK: users.id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('spouse_name');
            $table->string('spouse_surname');
            $table->string('spouse_email')->nullable();
            $table->string('spouse_contact')->nullable();
            $table->string('spouse_id');
            $table->integer('household_dependents')->index('idx_household_dependents');
            $table->integer('spouse_annual_income')->nullable();
            $table->string('spouse_proof_of_income')->nullable();
            $table->string('affadavit_spouse_not_working')->nullable();
            $table->string('affadavit_not_working')->nullable();
            $table->string('affadavit_both_not_working')->nullable();
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
        Schema::dropIfExists('user_spousal_information');
    }
};
