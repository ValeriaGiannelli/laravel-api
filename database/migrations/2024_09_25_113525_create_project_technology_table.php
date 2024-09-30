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
        Schema::create('project_technology', function (Blueprint $table) {

            // creo la colonna per la FK di project
            $table->unsignedBigInteger('project_id');

            // creo la fk di project
            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->cascadeOnDelete();


            // creo la colonna per la FK di technology
            $table->unsignedBigInteger('technology_id');

            // creo la FK di technology
            $table->foreign('technology_id')
                    ->references('id')
                    ->on('technologies')
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
