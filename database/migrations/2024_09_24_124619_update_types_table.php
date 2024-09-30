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
        Schema::table('types', function (Blueprint $table) {
            //aggiungo colonna slug
            $table->string('slug')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('types', function (Blueprint $table) {
            //cancello colonna
            $table->dropColumn('slug');
        });
    }
};
