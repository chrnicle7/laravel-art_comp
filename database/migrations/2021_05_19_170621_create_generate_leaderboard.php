<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateLeaderboard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generate_leaderboard', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_challenge');
            $table->bigInteger('id_submission');
            $table->bigInteger('id_achievement');
            $table->string('challenge_name');
            $table->string('username');
            $table->integer('score');
            $table->string('achievement_name');
            $table->integer('exp_gained');
            $table->integer('rank');
            $table->timestamps();
        });

        Schema::table('generate_leaderboard', function($table) {
            $table->foreign('id_challenge')->references('id')->on('challenges')->onDelete('cascade');
            $table->foreign('id_submission')->references('id')->on('submissions')->onDelete('cascade');
            $table->foreign('id_achievement')->references('id')->on('achievements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generate_leaderboard');
    }
}
