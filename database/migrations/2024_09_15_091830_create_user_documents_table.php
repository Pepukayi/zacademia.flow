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
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user_id')->comment('PK: users.id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('submission_type', 255)->nullable()->comment('Submission type e.g. bursary application')->index('idx_submission_type');
            $table->string('name', 255)->nullable()->comment('Document name')->index('idx_name');
            $table->string('filename')->nullable()->comment('Filename')->index('idx_filename');
            $table->addColumn('integer', 'size', ['length' => 10])->unsigned()->nullable()->comment('Document size');
            $table->string('doc_type', 255)->comment('Document Types')->index('idx_doc_type');;
            $table->string('file_ext', 15)->nullable()->comment('File extension i.e. png');
            $table->timestamp('created_at')->index('idx_created_at');
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
