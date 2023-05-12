<?php

// database/migrations/YYYY_MM_DD_HHmmss_create_salary_scales_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryScalesTable extends Migration
{
    public function up()
    {
        Schema::create('salary_scales', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Add name column
            $table->foreignId('job_title_id')->constrained()->onDelete('cascade');
            $table->decimal('minimum_salary', 10, 2);
            $table->decimal('maximum_salary', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary_scales');
    }
}
