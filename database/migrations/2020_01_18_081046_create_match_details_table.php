<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_date_id');
            $table->string('league')->nullable();
            $table->time('time')->nullable();

            $table->string('home_team')->nullable();
            $table->string('home_team_logo')->nullable();
            $table->string('asia_home_hdp')->nullable();
            $table->string('asia_home_odd')->nullable();
            $table->string('asia_home_goal_line_odd')->nullable();
            $table->string('mm_home_hdp')->nullable();
            $table->string('mm_home_goal_line')->nullable();

            $table->string('away_team')->nullable();
            $table->string('away_team_logo')->nullable();
            $table->string('asia_away_hdp')->nullable();
            $table->string('asia_away_odd')->nullable();
            $table->string('asia_away_goal_line_odd')->nullable();
            $table->string('mm_away_hdp')->nullable();
            $table->string('mm_away_goal_line')->nullable();

            $table->string('asia_goal_line')->nullable();
            $table->string('tip_team')->nullable();
            $table->integer('level')->default(0);
            $table->text('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_details');
    }
}
