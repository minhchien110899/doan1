<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixSomeColumnInPersonalizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personalizes', function (Blueprint $table) {
            $table->dropColumn('performance');
            $table->dropColumn('checkFirstTest');
            $table->integer('history_id');
            $table->integer("exam_number");
            $table->integer("expect_mark");
            $table->timestamp("expired_time");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personalizes', function (Blueprint $table) {
            $table->integer('performance')->nullable()->comment("muc do %");
            $table->integer('checkFirstTest')->comment("bai kiem tra dau vao - 0: not completed, 1: completed");
            $table->dropColumn('history_id');
            $table->dropColumn('exam_number');
            $table->dropColumn('expect_mark');
            $table->dropColumn('expired_time');
        });
    }
}
