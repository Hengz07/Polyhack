<?php

namespace App\Console\Commands;

use App\Models\Space\Building;
use App\Models\Space\BuildingLevel;
use App\Models\Space\Campus;
use App\Models\Space\Category;
use App\Models\Space\Space;
use App\Models\Space\Zone;
use App\Models\System\Department;
use App\Models\System\Ptj;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CopySpaceChild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:space_child';

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
        $sql = "select sp_id,
                sp_bu_id,
                sp_cam_id,
                sp_ptj_id,
                sp_dep_id,
                sp_cat_id,
                sp_bl_id,
                sp_parent_id,
                sp_code,
                sp_name,
                sp_address,
                sp_capacity,
                sp_facilities,
                sp_usage,
                sp_remark,
                sp_status,
                sp_paytouse,
                sp_bookable,
                sp_private,
                sp_timeslot,
                sp_latitude,
                sp_longitude,
                sp_has_tech,
                sp_min_tech,
                sp_max_tech,
                sp_creatorid,
                sp_createdate,
                sp_mofid,
                sp_mofdate,
                sp_del,
                sp_sas_id,
                sp_bill,
                ptj_code,
                dep_code
            from space
            left join ptj on ptj_id = sp_ptj_id
            left join department on dep_id = sp_dep_id
            where sp_del = '0'
            and sp_parent_id <> '0'";
        $results = DB::connection('ocsrs')->select( DB::raw($sql));

        $no = 1;
        foreach ($results as $result) {
            $insert['ocsrs_id'] = $result->sp_id;
            
            ## search building
            $insert['building_id'] = null;
            $building = Building::where("ocsrs_id", $result->sp_bu_id)->first();
            if ($building) {
                $insert['building_id'] = $building->id;
            }

            ## search campus
            $insert['campus_id'] = null;
            $campus = Campus::where('ocsrs_id', $result->sp_cam_id)->first();
            if ($campus) {
                $insert['campus_id'] = $campus->id;
            }

            ## get ptj 
            $insert['ptj_id'] = null;
            $ptj = Ptj::find($result->ptj_code);
            if ($ptj) {
                $insert['ptj_id'] = $ptj->id;
            }

            ## get department
            $insert['department_id'] = null;
            $department = Department::find($result->dep_code);
            if ($department) {
                $insert['department_id'] = $department->id;
            }

            ## get category
            $insert['category_id'] = null;
            $category = Category::where('ocsrs_id', $result->sp_cat_id)->first();
            if ($category) {
                $insert['category_id'] = $category->id;
            }

            ## building level
            $insert['building_level_id'] = null;
            $buildingLevel = BuildingLevel::where('ocsrs_id', $result->sp_bl_id)->first();
            if ($buildingLevel){
                $insert['building_level_id'] = $buildingLevel->id;
            }

            ## get parent id 
            $insert['parent_id'] = null;
            $space = Space::where('ocsrs_id', $result->sp_parent_id)->first();
            if ($space) {
                $insert['parent_id'] = $space->id;
            }

            $insert['code'] = $result->sp_code;
            $insert['name'] = $result->sp_name;
            $insert['address'] = $result->sp_address;
            $insert['capacity'] = $result->sp_capacity;
            $insert['facilities'] = $result->sp_facilities;
            $insert['usage'] = $result->sp_usage;
            $insert['remark'] = $result->sp_remark;
            $insert['status'] = $result->sp_status;
            $insert['paytouse'] = $result->sp_paytouse == '' ? 0 : $result->sp_paytouse;
            $insert['bookable'] = $result->sp_bookable == '' ? 0 : $result->sp_bookable;
            $insert['private'] = $result->sp_private == '' ? 0 : $result->sp_private;
            $insert['timeslot'] = $result->sp_timeslot == '' ? 'open': $result->sp_timeslot;
            $insert['latitude'] = $result->sp_latitude;
            $insert['longitude'] = $result->sp_longitude;
            $insert['has_tech'] = $result->sp_has_tech;
            $insert['min_tech'] = $result->sp_min_tech;
            $insert['max_tech'] = $result->sp_max_tech;

            Space::create($insert);
            $this->info($no++ . '. Data ' . $result->sp_name . ' have been transfer successfully');
        }
    }
}
