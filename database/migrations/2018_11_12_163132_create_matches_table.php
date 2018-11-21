<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->string("league");
            $table->smallInteger("week_number");
            $table->string("home");
            $table->string("away");
            $table->string("result")->nullable();
            $table->datetime("match_start_at")->nullable();
            $table->string("goal_over_under");

            $table->string("previous_odd")->nullable();
            $table->string("latest_odd")->nullable();
            $table->dateTime("previous_odd_created_at")->nullable();
            $table->dateTime("latest_odd_created_at")->nullable();
            $table->string("previous_goal_over_under")->nullable();
            $table->string("latest_goal_over_under")->nullable();
            $table->dateTime("previous_goal_over_under_created_at")->nullable();
            $table->dateTime("latest_goal_over_under_created_at")->nullable();
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
        Schema::dropIfExists('matches');
    }
}
