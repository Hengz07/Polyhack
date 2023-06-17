<?php

namespace App\Console\Commands;

use App\Models\Space\Campus;
use App\Models\Space\Zone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CopyZone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:zone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $campuses = Campus::get();

        foreach ($campuses as $campus) {
            $sql = "select * from zone where z_cam_id = :campus_id";
            $zones = DB::connection('ocsrs')->select( DB::raw($sql), ['campus_id' => $campus->ocsrs_id]);
            foreach ($zones as $kZone => $vZone) {
                $insert['ocsrs_id'] = $vZone->z_id;
                $insert['campus_id'] = $campus->id;
                $insert['name'] = $vZone->z_name;
                Zone::create($insert);
            }
        }

        
        $this->info('Data zone have been transfer successfully');
    }
}