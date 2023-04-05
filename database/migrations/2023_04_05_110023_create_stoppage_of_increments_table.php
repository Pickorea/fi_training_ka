<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoppageOfIncrementsTable extends Migration
{
    public function up()
    {
        Schema::create('stoppage_of_increments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('displinary_action_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('duration');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('displinary_action_id')->references('id')->on('displinary_actions')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stoppage_of_increments');
    }
}
