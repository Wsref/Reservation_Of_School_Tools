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
        Schema::create('reservationsals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('salle_id');
            $table->date('date_reserve');
            $table->time('time_reserve');
            $table->time('time_reserve_end');
            $table->integer('valide')->default(-1);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('salle_id')->references('id')->on('salles')->onDelete('cascade');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservationsals');
    }
};
