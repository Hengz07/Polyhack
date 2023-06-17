<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEwpAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewp_answer', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('report_id');
            $table->string('session', 100)->nullable();
            $table->string('sem', 100)->nullable();
            $table->jsonb('meta')->nullable();
            $table->string('date_taken', 100)->nullable();
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
        Schema::dropIfExists('ewp_answer');
    }
}
