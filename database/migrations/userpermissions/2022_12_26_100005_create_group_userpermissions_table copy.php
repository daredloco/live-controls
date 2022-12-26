<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_userpermissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_group_id')->constrained('user_groups', 'id')->cascadeOnDelete();
            $table->foreignId('user_permission_id')->constrained('user_permissions', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('group_userpermissions');
    }
};
