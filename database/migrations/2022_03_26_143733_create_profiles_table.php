<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('user_id');
            $table->string('profile_no', 25)->nullable();
            $table->string('alt_email', 50)->nullable();
            $table->string('alt_phone', 10)->nullable();
            $table->string('level', 20)->nullable();
            $table->jsonb('ptj')->nullable();
            $table->jsonb('department')->nullable();
            $table->string('status', 10)->nullable();
            $table->jsonb('position')->nullable();
            $table->jsonb('grade')->nullable();
            $table->jsonb('employment_type')->nullable();
            $table->jsonb('academic')->nullable();
            $table->jsonb('meta')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}


// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateProfilesTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('profiles', function (Blueprint $table) {
//             $table->unsignedBigInteger('user_id')->primary();
//             $table->string('um_no'); //Salary or Student ID
//             $table->char('ptj_id', 36)->nullable();
//             $table->char('department_id', 36)->nullable();
//             $table->string('office_no')->nullable();
//             $table->string('hp_no', 20)->nullable();
//             $table->string('status')->nullable();
//             $table->string("grade")->nullable();
//             $table->string("grade_desc")->nullable();
//             $table->string("position")->nullable();
//             $table->timestamps();

//             $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('profiles');
//     }
// }
