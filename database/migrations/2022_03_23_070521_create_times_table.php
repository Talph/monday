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
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->string('boardname')->nullable();
            $table->string('taskname')->nullable();
            $table->string('subtaskStatus')->nullable();
            $table->string('end_time')->nullable();
            $table->string('start_time')->nullable();
            $table->string('user')->nullable();
            $table->string('task_hours_used')->nullable();
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
        Schema::dropIfExists('times');
    }
};
