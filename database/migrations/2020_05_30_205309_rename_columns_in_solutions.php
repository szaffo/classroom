<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsInSolutions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->renameColumn('userId', 'user_id');
//            $table->renameColumn('taskId', 'task_id');
        });
        Schema::table('solutions', function (Blueprint $table) {
//            $table->renameColumn('userId', 'user_id');
            $table->renameColumn('taskId', 'task_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solutions', function (Blueprint $table) {
            //
        });
    }
}
