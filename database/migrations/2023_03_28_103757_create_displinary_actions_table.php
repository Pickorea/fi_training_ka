<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplinaryActionsTable extends Migration
{
    public function up()
    {
        Schema::create('displinary_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('action_type');
            $table->text('description');
            $table->string('severity_level');
            $table->timestamp('action_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('displinary_actions');
    }
}
