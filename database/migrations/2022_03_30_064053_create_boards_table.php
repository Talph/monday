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
        Schema::create('boards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('boardname')->nullable();
            $table->string('group')->nullable();
            $table->string('taskname')->nullable();
            $table->string('summary')->nullable();
            $table->string('status')->nullable();
            $table->string('owner')->nullable();
            $table->string('priority')->nullable();
            $table->string('time_req')->nullable();
            $table->date('date_logged')->nullable();
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
        Schema::dropIfExists('boards');
    }
};
