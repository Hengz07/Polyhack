<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddUuidExtension extends Migration
{
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        //users
        DB::statement('ALTER TABLE users ALTER COLUMN uuid DROP DEFAULT, ALTER COLUMN uuid TYPE uuid USING (uuid_generate_v4()), ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');
        
        //lookups
        DB::statement('ALTER TABLE lookups ALTER COLUMN uuid DROP DEFAULT, ALTER COLUMN uuid TYPE uuid USING (uuid_generate_v4()), ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');

        //profiles
        DB::statement('ALTER TABLE profiles ALTER COLUMN uuid DROP DEFAULT, ALTER COLUMN uuid TYPE uuid USING (uuid_generate_v4()), ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');

        //ewp_assign
        DB::statement('ALTER TABLE ewp_assign ALTER COLUMN uuid DROP DEFAULT, ALTER COLUMN uuid TYPE uuid USING (uuid_generate_v4()), ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');

        //ewp_calendar
        DB::statement('ALTER TABLE ewp_calendar ALTER COLUMN uuid DROP DEFAULT, ALTER COLUMN uuid TYPE uuid USING (uuid_generate_v4()), ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');

        //ewp_answer
        DB::statement('ALTER TABLE ewp_answer ALTER COLUMN uuid DROP DEFAULT, ALTER COLUMN uuid TYPE uuid USING (uuid_generate_v4()), ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');

        //ewp_overall_report
        DB::statement('ALTER TABLE ewp_overall_report ALTER COLUMN uuid DROP DEFAULT, ALTER COLUMN uuid TYPE uuid USING (uuid_generate_v4()), ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');

        //ewp_chat
        DB::statement('ALTER TABLE ewp_chat ALTER COLUMN uuid DROP DEFAULT, ALTER COLUMN uuid TYPE uuid USING (uuid_generate_v4()), ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();'); 
    }

    public function down()
    {
    }
}
