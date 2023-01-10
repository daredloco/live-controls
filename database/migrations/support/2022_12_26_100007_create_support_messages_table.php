<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livecontrols_support_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_ticket_id')->constrained('livecontrols_support_tickets', 'id')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livecontrols_support_messages');
    }
};
