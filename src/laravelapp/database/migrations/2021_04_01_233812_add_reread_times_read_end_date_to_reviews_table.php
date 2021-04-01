<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRereadTimesReadEndDateToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('reread_times')->nullable(false)->after('review_niy')->default("1");
            $table->date('read_end_date_for_first')->nullable(false)->after('reread_times')->default('2021-04-01');
            $table->date('read_end_date_for_second')->nullable()->after('read_end_date_for_first');
            $table->date('read_end_date_for_third')->nullable()->after('read_end_date_for_second');
            $table->date('read_end_date_for_fourth')->nullable()->after('read_end_date_for_third');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('reread_times');
            $table->dropColumn('read_end_date_for_first');
            $table->dropColumn('read_end_date_for_second');
            $table->dropColumn('read_end_date_for_third');
            $table->dropColumn('read_end_date_for_fourth');
        });
    }
}
