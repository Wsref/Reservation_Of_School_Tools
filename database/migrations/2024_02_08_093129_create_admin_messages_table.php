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
        Schema::create('admin_messages', function (Blueprint $table) {
            $table->id('reply_id');
            $table->integer('replier_id');
            $table->integer('replies_to_id');
            $table->integer('replies_to_request_id') ;
            $table->text('reply_msg');
            $table->integer('response_status') ;
            $table->date('reply_date');
            $table->time('reply_time');
            $table->timestamp('reply_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_messages');
    }
};
