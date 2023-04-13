<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeductionsTable extends Migration
{
    public function up()
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('displinary_action_id');
            $table->unsignedBigInteger('employee_id');
            // $table->string('type');
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            $table->foreign('displinary_action_id')->references('id')->on('displinary_actions')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deductions');
    }
}

