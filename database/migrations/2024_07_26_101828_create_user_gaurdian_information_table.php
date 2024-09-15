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
        Schema::create('user_gaurdian_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('PK: users.id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('number_parents_guardians')->index('idx_number_parents_guardians');
            $table->string('parent_guardian_name');
            $table->string('parent_guardian_surname');
            $table->string('parent_guardian_email')->nullable();
            $table->string('parent_guardian_phone_number')->nullable();
            $table->string('parent_id');
            $table->string('other_parent_guardian_name')->nullable();
            $table->string('other_parent_guardian_surname')->nullable();
            $table->string('other_parent_guardian_email')->nullable();
            $table->string('other_parent_guardian_phone_number')->nullable();
            $table->string('other_parent_id')->nullable();
            $table->integer('parents_dependents');
            $table->string('parental_dependence')->nullable();
            $table->integer('number_working_parents_guardians')->index('idx_number_working_parents_guardians');
            $table->string('affadavit_parents_dont_work')->nullable();
            $table->integer('parent_annual_income')->nullable();
            $table->string('parent_proof_of_income')->nullable();
            $table->integer('other_parent_annual_income')->nullable();
            $table->string('other_parent_proof_of_income')->nullable();
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
        Schema::dropIfExists('user_gaurdian_information');
    }
};
