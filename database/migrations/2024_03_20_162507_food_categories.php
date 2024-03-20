<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        
        DB::table('food_categories')->insert([
            ['name' => 'food'],
            ['name' => 'drink'],
            ['name' => 'dessert'],
            ['name' => 'appetizer'],
            ['name' => 'main course'],
            ['name' => 'side dish'],
            ['name' => 'hot drink'],
            ['name' => 'cold drink'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
