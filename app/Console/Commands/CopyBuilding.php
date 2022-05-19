<?php

namespace App\Console\Commands;

use App\Models\Space\Building;
use App\Models\Space\Campus;
use App\Models\Space\Zone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CopyBuilding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:building';

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
        $sql = "select * from building where bu_del = '0'";
        $buildings = DB::connection('ocsrs')->select( DB::raw($sql));
        // dd($buildings);
        foreach ($buildings as $kBuilding => $vBuilding) {

            ## get zone data
            $zone = Zone::where('ocsrs_id', $vBuilding->bu_zid)->first();

            $insert['ocsrs_id'] = $vBuilding->bu_id;
            if($zone) {
                $insert['campus_id'] = $zone->campus->id;
                $insert['zone_id'] = $zone->id;
            }
            else {
                $insert['campus_id'] = null;
                $insert['zone_id'] = null;
            }
            $insert['code'] = $vBuilding->bu_code;
            $insert['name'] = $vBuilding->bu_name;
            $insert['short_name'] = $vBuilding->bu_shortname;
            $insert['latitude'] = $vBuilding->bu_latitude;
            $insert['longitude'] = $vBuilding->bu_longitude;
            Building::create($insert);
            $this->info('Data ' . $vBuilding->bu_name . ' has been transfer successfully');
        }
    
    }
}
