<?php

// database/migrations/2023_03_27_000004_create_suspensions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuspensionsTable extends Migration
{
    public function up()
    {
        Schema::create('suspensions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('displinary_action_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('days');
             $table->text('reason');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('with_pay');
            $table->timestamps();

            $table->foreign('displinary_action_id')->references('id')->on('displinary_actions')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('suspensions');
    }
}
