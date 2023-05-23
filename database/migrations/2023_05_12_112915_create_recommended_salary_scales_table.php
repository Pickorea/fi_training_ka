<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendedSalaryScalesTable extends Migration
{
    public function up()
    {
        Schema::create('recommended_salary_scales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('job_title_id')->constrained()->onDelete('cascade');
            $table->unsignedDecimal('recommended_minimum_salary', 10, 2);
            $table->unsignedDecimal('recommended_maximum_salary', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommended_salary_scales');
    }
}
