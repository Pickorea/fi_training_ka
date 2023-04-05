<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIndexToDisplinaryActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('displinary_actions', function (Blueprint $table) {
        $table->unique(['employee_id', 'action_type']);
    });
}

public function down()
{
    Schema::table('displinary_actions', function (Blueprint $table) {
        $table->dropUnique(['employee_id', 'action_type']);
    });
}

}
