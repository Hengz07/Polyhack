<?php

namespace App\Console\Commands;

use App\Models\Space\Building;
use App\Models\Space\BuildingLevel;
use App\Models\Space\Campus;
use App\Models\Space\Zone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CopyBuildingLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:building_level';

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
        $sql = "select * from building_level where bl_del = '0'";
        $buildingLevels = DB::connection('ocsrs')->select( DB::raw($sql));
        foreach ($buildingLevels as $buildingLevel) {

            ## get zone data
            $building = Building::where('ocsrs_id', $buildingLevel->bl_bu_id)->first();

            $insert['ocsrs_id'] = $buildingLevel->bl_id;
            
            if ($building) {
                $insert['building_id'] = $building->id;
            }
            else {
                $insert['building_id'] = null;
            }

            $insert['name'] = $buildingLevel->bl_name;
            $insert['short_name'] = $buildingLevel->bl_shortname;
            $insert['sequence'] = $buildingLevel->bl_sequence;
            BuildingLevel::create($insert);
            $this->info('Data ' . $buildingLevel->bl_name . ' has been transfer successfully');
        }
    
    }
}