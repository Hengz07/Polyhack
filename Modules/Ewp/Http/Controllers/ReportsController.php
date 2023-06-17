<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ewp\Entities\{Reports, Schedules, Answers};
use Modules\Site\Entities\{Profile, User};

class ReportsController extends Controller
{
    protected $baseView = 'ewp::dashboards.reports';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard(Request $request)
    {
        //SESSION AND SEM REFER TO USER'S TYPE
        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', '"AK"')->first();

        $limit = 10;
        $search = $request->has('q') ? $request->get('q') : null;

        $reports = Reports::with('profile.user')->with('assign')->where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('session', 'like', '%' . $search . '%')
                      ->orWhere('semester', 'like', '%' . $search . '%');
            }   
        })
        ->orderBy('id', 'asc')
        ->paginate($limit);
        
        session()->put('url.intended', url()->current());
        
        return view('ewp::dashboards.dashboard', compact('reports'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        //SESSION AND SEM REFER TO USER'S TYPE
        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', '"AK"')->first();
        $users     = User::where('id' , $profiles['user_id'])->first();

        //SCHEDULES RETRIEVE
        $usertype = auth()->user()->user_type;

        if($usertype == 'staff'){
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->where('category', 'LIKE', '%ST%')->first();
        }
        elseif($usertype == 'student'){
            //REFER SCHEDULES BASED ON STUDENT TYPE (UG, PG, PASUM)
            //TRY EXPLODE FOR whereIN to work
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->where('category', 'LIKE', '%UG%')
                                                                                                    ->orWhere('category', 'LIKE', '%PG%')
                                                                                                    ->orWhere('category', 'LIKE', '%PASUM%')
                                                                                                    ->first();
        };

        //RETRIEVE JSON/JSONB DATA
        // dd($jsonb_ptj);
        if($profiles['ptj'] != null){
            $jsonb_ptj = $profiles['ptj'];
        }
        else{
            $json_ptj = null;
        }

        if($profiles['department'] != null){
            $jsonb_department = $profiles['department'];
        }
        else{
            $json_department = null;
        }

        if($profiles['meta'] != null){
            $meta = $profiles['meta'];
        }
        else{
            $meta = null;
        }
        //

        return view('ewp::dashboards.reports.create', compact('schedules', 'users', 'profiles', 'jsonb_ptj', 'jsonb_department', 'meta'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */   
    public function store(Request $request)
    {
        //OTHER TABLES
        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', '"AK"')->first();
        $users     = User::where('id' , $profiles['user_id'])->first();

        //SCHEDULES RETRIEVE
        $usertype = auth()->user()->user_type;

        if($usertype == 'staff'){
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->where('category', 'LIKE', '%ST%')->first();
        }
        elseif($usertype == 'student'){
            //REFER SCHEDULES BASED ON STUDENT TYPE (UG, PG, PASUM)
            //TRY EXPLODE FOR whereIN to work
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->where('category', 'LIKE', '%UG%')
                                                                                                    ->orWhere('category', 'LIKE', '%PG%')
                                                                                                    ->orWhere('category', 'LIKE', '%PASUM%')
                                                                                                    ->first();
        };

        //DECLARE
        $alt_phone = $alt_email = '';
        
        $alt_email = $request->input('alt_email');
        $alt_phone = $request->input('alt_phone');

        $items_p = [
            'alt_email' => $alt_email,
            'alt_phone' => $alt_phone,
        ];

        $session    = $schedules['session'];
        $sem        = $schedules['semester'];
        
        $profile_id = $profiles['id'];

        $reports = Reports::where('profile_id', $profiles['id'])->where('session', $schedules['session'])->where('sem', $schedules['semester'])->first();

            if(!isset($reports) || $reports['status'] == '' || $reports['status'] == null)
                $status = 'V';
            else
                $status = $reports['status'];
                
        $items_r = [
            'session'    => $session,
            'sem'        => $sem,
            'profile_id' => $profile_id,
            'status'     => $status
        ];

        Profile::updateOrCreate(['user_id' => auth()->user()->id], $items_p);

        $result  = Reports::updateOrCreate(['profile_id' => $profile_id, 'session' => $session, 'sem' => $sem], $items_r);
        
        $new     = Reports::findOrFail($result->id);
        
        return redirect()->route('ewp.survey.index', $new->uuid)->with('toast_success', 'Report has been successfully saved.');
    }
    
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('ewp::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

    }

    public function getResult(Request $request)
    {   
        $profiles = Profile::where('user_id', auth()->user()->id)->where('status', '"AK"')->first();
        
        $search = $request->search;
        
        if ($search == '') {
            $reports = Reports::where('profile_id', $profiles['id'])
                            ->orderBy('id', 'asc')
                            ->get();
        } 
        else {
            $reports = Reports::where('profile_id', $profiles['id'])
                            ->where('session', 'ilike', '%' . $search . '%')->orWhere('sem', 'ilike', '%' . $search . '%')
                            ->orderBy('id', 'asc')
                            ->get();
        }

        //REVISE THESE CODES (DEFINING DATA TO SEND TO JQUERY)
        $fullresult = array();

        //REPORT LOOPING TO ACCESS DATA FROM EACH REPORTS
        foreach($reports as $result)
        {
            
            $dataA = $dataB = $dataC = 0;
            $intervention = '';
            $data = array();

            $scaleresults = $result['scale'];
            
            // dd($scaleresults);
            foreach ($scaleresults as $scaleresult => $sr){

                //DATA
                if ($scaleresults['D']){
                    $dataD = $scaleresults['D']['value'] * 2;
                }

                if ($scaleresults['A']){
                    $dataA = $scaleresults['A']['value'] * 2;
                }

                if ($scaleresults['S']){
                    $dataS = $scaleresults['S']['value'] * 2; 
                }
                
                //intervention
                if ($scaleresults['A']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                    $scaleresults['D']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                    $scaleresults['S']['status']['intervention'] == 'INTERVENSI KHUSUS')
                {
                    $intervention = 'INTERVENSI KHUSUS';
                }

                else
                {
                    $intervention = 'INTERVENSI UMUM';
                }
            }

            $data[] = $dataA;
            $data[] = $dataD;
            $data[] = $dataS;
            
            $sessem = $result->session.' - '.$result->sem;
                
            $fullresult[] = array(
                'name' => $sessem,
                'data' => $data,
                'pointPlacement' => $intervention
            );
        }

        return response()->json($fullresult);
    }
}
