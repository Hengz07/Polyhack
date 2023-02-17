<?php

//namespace App\Http\Controllers;
namespace Modules\Ewp\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Permission;

use Modules\Ewp\Entities\{Lookups, Reports, Schedules, Answers};
use Modules\Site\Entities\{Modules, Profile, User};

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
            $results = Reports::select('session')->with('profile.user')->with('assign')->where('value_local', 'ilike', '%' . $search . '%')->distinct()->orderBy('session')->get();
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
            $results = Reports::select('sem')->with('profile.user')->with('assign')->where('value_local', 'ilike', '%' . $search . '%')->distinct()->orderBy('sem')->get();
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
            $results = Profile::select('ptj')->distinct()->get();
        } else {
            $results = Profile::select('ptj')->where('value_local', 'ilike', '%' . $search . '%')->distinct()->get();
        }

        dd($results);
        
        $response = array();
        
        foreach ($results as $result) {
            $faculty = $result['ptj'][0]['code'].' - '.$result['ptj'][0]['desc'];
            $response[] = array(
                "id"      => $faculty,
                "faculty" => $faculty,
            );
        }

        echo json_encode($response);
        exit;
    }
    
    public function getStatus(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $results = Reports::select('scale')->distinct()->get();
        } else {
            $results = Reports::select('scale')->where('value_local', 'ilike', '%' . $search . '%')->distinct()->get();
        }
        
        $response = array();
        
        foreach ($results as $result) {
            $response[] = array(
                "id"     => '',
                "status" => 'test',
            );
        }

        echo json_encode($response);
        exit;
    }

    public function getOfficer(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $results = User::select('name')->role([5])->distinct()->get();
        } else {
            $results = User::select('name')->role([5])->where('value_local', 'ilike', '%' . $search . '%')->distinct()->get();
        }
        
        $response = array();
        
        foreach ($results as $result) {
            $response[] = array(
                "id"      => $result->id,
                "officer" => $result['name'],
            );
        }

        echo json_encode($response);
        exit;
    }

    //Get Officer For Assign Officer Modal
    public function getModalOfficer(Request $request)
    {
        // $test = auth()->user();

        $search = $request->search;

        // dd($test);

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
