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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('estimation_cost');
            $table->integer('engineer_owner');
            $table->string('project_owner');
            $table->string('actual_cost');
            $table->string('pdf_attachment');
            $table->string('excel_attachment');
            $table->integer('vote_number');
            //multiple users
            $table->unsignedBigInteger('assigned_to')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
