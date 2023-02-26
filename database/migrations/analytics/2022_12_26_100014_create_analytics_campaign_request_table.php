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
        Schema::create('livecontrols_analytics_campaign_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('livecontrols_analytics_campaigns', 'id')->cascadeOnDelete();
            $table->foreignId('request_id')->nullable()->constrained('livecontrols_analytics_requests', 'id')->nullOnDelete();
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
        Schema::dropIfExists('livecontrols_analytics_campaign_requests');
    }
};
