<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_challenge');
            $table->bigInteger('id_user');
            $table->string('link');
            $table->integer('score');
            $table->text('host_feedback');
            $table->timestamps();
        });

        Schema::table('submissions', function($table) {
            $table->foreign('id_challenge')->references('id')->on('challenges')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submission');
    }
}
