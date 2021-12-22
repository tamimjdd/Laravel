<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_verifications', function (Blueprint $table) {
            $table->unsignedBigInteger('usr_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->integer('reg_id',10)->nullable();
            $table->foreign('usr_id')
                ->references('id')
                ->on('users')
                ->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_verifications');
    }
}
