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
        Schema::table('projects', function (Blueprint $table) {
            //aggiungo la colonna che farà riferimento alla tabella dei tipi, quindi la mia FK
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            // creo la FK con dei parametri
            $table->foreign('type_id')
                    ->references('id')
                    ->on('types')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //elimino prima la FK richiamando il nome della colonna
            $table->dropForeign(['type_id']);

            // poi elimino la colonna
            $table->dropDown('type_id');
        });
    }
};
