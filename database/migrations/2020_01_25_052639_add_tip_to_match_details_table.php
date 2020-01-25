<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipToMatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_details', function (Blueprint $table) {
            $table->string('tip_odd')->nullable();
            $table->string('home_asia_hdp')->nullable();
            $table->string('away_asia_hdp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_details', function (Blueprint $table) {
            $table->dropColumn("tip_odd");
            $table->dropColumn("home_asia_hdp");
            $table->dropColumn("away_asia_hdp");
        });
    }
}
