<?php

namespace App\Console\Commands;

use App\Models\Space\Campus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CopyCampus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:campus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy campus table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sql = "select * from campus";
        $campuses = DB::connection('ocsrs')->select( DB::raw($sql));
            
        foreach ($campuses as $kCampus => $vCampus) {
            $insertCampus['ocsrs_id'] = $vCampus->cam_id;
            $insertCampus['code'] = $vCampus->cam_code;
            $insertCampus['name'] = $vCampus->cam_name;
            Campus::create($insertCampus);
        }
        $this->info('Data campus have been transfer successfully');
    }
}