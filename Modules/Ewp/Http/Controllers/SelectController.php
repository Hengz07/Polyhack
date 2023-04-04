<?php

//namespace App\Http\Controllers;
namespace Modules\Ewp\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Permission;

use Modules\Ewp\Entities\{Lookups, Reports, Schedules, Answers};
use Modules\Site\Entities\{Modules, Profile, User};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    /**
     * Display a listing of the departments for select dropdown.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function getCategory(Request $request)
    {
        $search = $request->search;
        
        if ($search == '') {
            $results = Lookups::select('value_local', 'id','code')
                            ->where('key', 'category')
                            ->orderBy('value_local')->get();
        } else {
            $results = Lookups::select('value_local', 'id','code')
                            ->where('key', 'category')
                            ->where('value_local', 'ilike', '%' . $search . '%')
                            ->orderBy('value_local')->get();
        }

        $response = array();
        
        foreach ($results as $result) {
            $response[] = array(
                "id"   => $result->id,
                "text" => $result->value_local,
                "code" => $result->code,
            );
        }

        echo json_encode($response);
        exit;
    }

    //Select2 For Searching (Rekod Saringan / Khusus)
    public function getSession(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $results = Reports::select('session')->with('profile.user')->with('assign')->distinct()->orderBy('session')->get();
        } else {
            $results = Reports::select('session')->with('profile.user')->with('assign')->where('session', 'ilike', '%' . $search . '%')->distinct()->orderBy('session')->get();
        }
        
        $response = array();
        
        foreach ($results as $result) { 
            $response[] = array( 
                "id"      => $result->session, 
                "session" => $result->session, 
            ); 
        } 

        echo json_encode($response);
        exit;
    }

    public function getSemester(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $results = Reports::select('sem')->with('profile.user')->with('assign')->distinct()->orderBy('sem')->get();
        } else {
            $results = Reports::select('sem')->with('profile.user')->with('assign')->where('sem', 'ilike', '%' . $search . '%')->distinct()->orderBy('sem')->get();
        }
        
        $response = array();
        
        foreach ($results as $result) {
            $response[] = array(
                "id"       => $result->sem,
                "semester" => $result->sem,
            );
        }

        echo json_encode($response);
        exit;
    }

    public function getFaculty(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $results =
            Profile::join('ewp_overall_report', 'profiles.user_id', '=', 'ewp_overall_report.profile_id')
            ->select('profiles.ptj')->distinct()->get();
        } else {
            $results = Profile::join('ewp_overall_report', 'profiles.user_id', '=', 'ewp_overall_report.profile_id')
                ->select('profiles.ptj')->where('profiles.ptj', 'ilike', '%' . $search . '%')
                ->distinct()->get();
        }
        
        $response = array();
        
        foreach ($results as $result) {
            if($result['ptj'] != null){
                $faculty = $result['ptj'][0]['code'].' - '.$result['ptj'][0]['desc'];
                
                $response[] = array(
                    "id"      => $result['ptj'][0]['code'],
                    "faculty" => $faculty,
                );
            }
        }

        echo json_encode($response);
        exit;
    }

    public function getStatus(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            $results = Reports::selectRaw("scale->'A'->'status'->>'intervention' as interventions")
            ->groupBy('interventions')->distinct()
            ->get();
        } else {
            $results = Reports::selectRaw("scale->'A'->'status'->>'intervention' as interventions")
            ->whereRaw("scale->'A'->'status'->>'intervention' ilike ?", ['%' . $search . '%'])
            ->groupBy('interventions')->distinct()
            ->get();
        }



        $response = array();

        foreach ($results as $result) {
            if ($result['interventions'] != null) {
                $status = $result['interventions'];

                $response[] = array(
                    "id"      => $result['interventions'],
                    "status" => $status,
                );
            }
        }

        echo json_encode($response);
        exit;
    }

    public function getOfficer(Request $request)
    {
        $search = $request->search;
        
        if ($search == '') {
            $results = User::select('id','uuid','name')->role([5])->distinct()->get();
        } else {
            $results = User::select('id','uuid','name')->role([5])->where('name', 'ilike', '%' . $search . '%')->distinct()->get();
        }
        
        $response = array();
        
        foreach ($results as $result) {
            $response[] = array(
                "id"      => $result->id,
                "uuid"    => $result['uuid'],
                "officer" => $result['name'],
            );
        }

        // dd($response);

        echo json_encode($response);
        exit;
    }

    //Get Officer For Assign Officer Modal
    public function getModalOfficer(Request $request)
    {
        $search = $request->search;

        $users = User::role([5])->where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('name', 'like', '%' . $search . '%');
                $query->orWhere('email', 'like', '%' . $search . '%');
            }
        })->orderBy('name', 'asc')->paginate(100);

        $response = array();
        
        foreach ($users as $user) {
            $response[] = array(
                "id" => $user->id,
                "text" => $user->name,
            );
        }

        echo json_encode($response);
        exit;
    }
}
