<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewp_questions', function (Blueprint $table) {
            $table->id();
            $table->string('ewp_sections')->nullable();
            $table->string('ewp_sections_code', 5)->nullable();
            $table->string('ewp_desc_bm')->nullable();
            $table->string('ewp_desc_bi')->nullable();
            $table->string('ewp_versions')->unique();
            $table->integer('ewp_order_id')->nullable();
            $table->integer('ewp_status', )->nullable();
            $table->integer('created_id')->nullable();
            $table->integer('updated_id')->nullable();
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
        Schema::dropIfExists('ewp_questions');
    }
}
