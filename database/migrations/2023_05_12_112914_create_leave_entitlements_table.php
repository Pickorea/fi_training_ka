<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveEntitlementsTable extends Migration
{
    public function up()
    {
        Schema::create('leave_entitlements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_title_id');
            $table->integer('annual_leave_entitlement');
            $table->integer('sick_leave_entitlement');
            $table->timestamps();
            
            $table->foreign('job_title_id')
                ->references('id')
                ->on('jobtitles')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_entitlements');
    }
}
