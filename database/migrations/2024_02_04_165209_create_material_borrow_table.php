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
        Schema::create('material_borrow', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('material');//! should be material id , so we will use JOINS
            $table->integer('quantity');
            $table->date('dateBorrow');
            $table->time('timeBorrow');
            // $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_borrow');
    }
};
