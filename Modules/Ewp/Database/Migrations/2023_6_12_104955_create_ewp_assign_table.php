<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEwpAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewp_assign', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('report_id');
            $table->integer('officer_id');
            $table->json('meta')->nullable();
            $table->string('status', 2)->nullable();
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
        Schema::dropIfExists('ewp_assign');
    }
}
