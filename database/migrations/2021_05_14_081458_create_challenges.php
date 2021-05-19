<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallenges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc');
            $table->bigInteger('id_tag');
            $table->date('date_start_submission');
            $table->date('date_end_submission');
            $table->date('date_announcement');
            $table->bigInteger('id_host');
            $table->string('further_desc_link');
            $table->timestamps();
        });

        Schema::table('challenges', function($table) {
            $table->foreign('id_tag')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('id_host')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
