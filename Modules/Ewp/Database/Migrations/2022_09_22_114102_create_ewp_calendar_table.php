<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEwpCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewp_calendar', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('session', 10);
            $table->string('semester', 2);
            $table->string('status', 10)->nullable();
            $table->string('category', 25);
            $table->string('remark', 150)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('createdby', 100)->nullable();
            $table->string('updatedby', 100)->nullable();
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
        Schema::dropIfExists('ewp_calendar');
    }
}
