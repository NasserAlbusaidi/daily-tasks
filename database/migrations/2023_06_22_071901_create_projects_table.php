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
            $table->integer('estimation_cost');
            $table->integer('engineer_owner');
            $table->unsignedBigInteger('project_owner');
            $table->integer('actual_cost');
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
