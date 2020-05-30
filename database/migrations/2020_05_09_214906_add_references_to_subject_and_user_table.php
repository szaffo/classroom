<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferencesToSubjectAndUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subject_user', function (Blueprint $table) {
            $table->integer('user_id')->references('id')->on('users')->change();
            $table->integer('subject_id')->references('id')->on('subjects')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subject_user', function (Blueprint $table) {
            //
        });
    }
}
