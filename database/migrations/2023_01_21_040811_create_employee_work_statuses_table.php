<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeWorkStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_work_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('vacancy_id');
            $table->string('recommended_salary_scale_id')->nullable();
            $table->string('unestablished');
            // $table->string('status')->default('Active');
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
        Schema::dropIfExists('employee_work_statuses');
    }
}