<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLevelColunmToTestexamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testexams', function (Blueprint $table) {
            $table->integer('level')->nullable()->comment("1-easy;2-medium;3-hard;4-general");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testexams', function (Blueprint $table) {
            $table->integer('level')->nullable();
        });
    }
}
