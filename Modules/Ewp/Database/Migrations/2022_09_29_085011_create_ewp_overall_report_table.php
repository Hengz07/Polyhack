<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEwpOverallReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewp_overall_report', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('profile_id')->nullable();
            $table->string('session', 9)->nullable();
            $table->string('sem', 8)->nullable();
            $table->string('status', 1)->nullable();
            $table->jsonb('scale')->nullable();
            $table->jsonb('part_d')->nullable();
            $table->jsonb('part_a')->nullable();
            $table->jsonb('part_s')->nullable();
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
        Schema::dropIfExists('ewp_overall_report');
    }
}
