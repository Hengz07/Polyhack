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
        $limit = 10;
        $search = $request->has('q') ? $request->get('q') : null;

        $reports = Reports::where(function ($query) use ($search) {
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
        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', 'AK')->first();
        $users     = User::where('id' , $profiles['user_id'])->first();

        //SCHEDULES RETRIEVE
        $usertype  = auth()->user()->user_type;

        if($usertype == 'staff'){
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->whereIn('category', ['ST'])->first();
        }
        elseif($usertype == 'student'){
            //REFER SCHEDULES BASED ON STUDENT TYPE (UG, PG, PASUM)
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->whereIn('category', ['UG', 'PG', 'PASUM'])->first();
        }
        else{
            return view('ewp::dashboards.dashboard')->with('toast_waring', 'User does not exist.');
        }

        //RETRIEVE JSON/JSONB DATA
        $jsonb_ptj = $profiles['ptj'];
            foreach ($jsonb_ptj as $jsonb_ptj)

        $jsonb_department = $profiles['department'];
            foreach ($jsonb_department as $jsonb_department)

        $meta = $profiles['meta'];
            foreach ($meta as $meta)
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
        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', 'AK')->first();
        $users     = User::where('id' , $profiles['user_id'])->first();

        //SCHEDULES RETRIEVE
        $usertype  = auth()->user()->user_type;

        if($usertype == 'staff'){
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->whereIn('category', ['ST'])->first();
        }
        elseif($usertype == 'student'){
            //REFER SCHEDULES BASED ON STUDENT TYPE (UG, PG, PASUM)
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->whereIn('category', ['UG', 'PG', 'PASUM'])->first();
        }

        //DECLARE
        $alt_phone = $alt_email = '';

        $alt_email = $request->input('alt_email');
        $alt_phone = $request->input('alt_phone');

        $items_p = [
            'alt_email' => $alt_email,
            'alt_phone' => $alt_phone,
        ];

        if($usertype == 'staff' && str_contains($schedules['session'], date('Y'))){
            $session    = date('Y');
            $sem        = '1';
        }
        elseif($usertype == 'student'){
            $session    = $schedules['session'];
            $sem        = $schedules['semester'];
        }

        $profile_id = $profiles['id'];

        $reports = Reports::where('profile_id', $profiles['id'])->first();

        if(!isset($reports) || $reports['status'] == '')
            $status     = 'V';
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
        // $uuid = Reports::where('id', $result->id)->pluck('uuid')->first();

        return redirect()->route('ewp.servey.index', $new->uuid)->with('toast_success', 'Report has been successfully saved.');
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

    public function ajax()
    {
        // if()
        // {

        // }
        
        // {

        //     if(req)
        //     {
        //         $list = report::where(uuid)->first();
        //     }
        //     else
        //     {
        //         $list = report::where()->get();
        //     } 

        //     foreach(){
        //      $result = [{   name: '2022/2023 1',
        //         data: [65, 24, 11],
        //         pointPlacement: 'INTERVENSI UMUM'
        //     }]
          
        //     }

        // }
        
    }
}