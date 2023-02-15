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
            $table->integer('work_status_id')->unsigned();
            $table->integer('department_id')->unsigned();
     		$table->string('present_address')->nullable();
			$table->text('pf_number')->nullable();
			$table->date('joining_date')->nullable();
			$table->string('gender', 1)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('marital_status')->nullable()->comment('1 for Married, 2 Single, 3 for Divorced, 4 for Separated, 5 for Widowed');
			$table->string('picture');
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
        Schema::dropIfExists('employees');
    }
}
