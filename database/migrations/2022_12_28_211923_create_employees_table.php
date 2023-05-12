<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->unsignedBigInteger('work_status_id');
        $table->unsignedBigInteger('department_id');
        $table->unsignedBigInteger('job_title_id');
        $table->unsignedBigInteger('salary_scale_id');
        $table->unsignedBigInteger('leave_entitlement_id'); 
        $table->string('present_address');
        $table->string('pf_number');
        $table->date('joining_date');
        $table->string('gender');
        $table->date('date_of_birth');
        $table->string('marital_status');
        $table->string('picture');
        $table->timestamps();

        // $table->foreign('leave_entitlement_id')->references('id')->on('leave_entitlements');
        // $table->foreign('salary_scale_id')->references('id')->on('salary_scales');
        $table->foreign('work_status_id')->references('id')->on('work_status');
        $table->foreign('department_id')
        ->references('id')
        ->on('departments');
        // $table->foreign('job_title_id')->references('id')->on('job_titles');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
