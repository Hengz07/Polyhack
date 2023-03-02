<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Facade\FlareClient\Report;
use Spatie\Permission\Models\Role;

use Modules\Ewp\Entities\{Reports, Schedules, Answers, Assign};
use Modules\Site\Entities\{Profile, User};
use Illuminate\Support\Facades\DB;

class EwpController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $limit = 10;
        $search = $request->has('q') ? $request->get('q') : null;

        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', '"AK"')->first();

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

        $reports = Reports::where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('session', 'like', '%' . $search . '%')
                      ->orWhere('sem', 'like', '%' . $search . '%');
            }
        })
        ->where('profile_id', $profiles['id'])
        ->orderBy('id', 'asc')
        ->paginate($limit);

        // dd($reports);

        session()->put('url.intended', url()->current());

        return view('ewp::dashboards.dashboard', compact('reports', 'schedules'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    }

    public function adminindex(Request $request)
    {   
        $roles = auth()->user()->roles->pluck('id')->toArray();

    #====================================Pengiraan purata Interview khursus dan Umum================================#
        $results = DB::table('ewp_overall_report')
                        ->selectRaw("scale->'A'->'status'->>'intervention' as intervention")
                        ->get();
    #===============================================================================================================#                        

     #=========================Info Officer based on student=========================#       
        $assign = User::role([5])->orderBy('name', 'desc')->with('get_assign')->get();
     #===============================================================================#

    #-------------------Total Semua User untuk student and staff--------------------#
        #totaloveralluser
        $totaloverall = User::select(DB::raw('COUNT(user_type) as count3'))
                        ->get();
    
        #total pelajar
        $totalsemuapelajar = User::select(DB::raw('COUNT(user_type) as count'))
                        ->where('user_type','=','student')
                        ->get();
        
        #total staff
        $totalsemuastaff = User::select(DB::raw('COUNT(user_type) as count2'))
                        ->where('user_type','=','staff')
                        ->get();

        foreach($totalsemuapelajar as $put){

        }
        foreach($totalsemuastaff as $put2){

        }
        foreach($totaloverall as $put3){

        }

        $staffsurvey = Reports::join('users','ewp_overall_report.profile_id','=','users.id')
                                ->select('users.user_type', DB::raw("count(ewp_overall_report.profile_id) as staffcount"))
                                ->where('users.user_type','=','staff')
                                ->groupBy('users.user_type')
                                ->get();

        $studentsurvey = Reports::join('users', 'ewp_overall_report.profile_id', '=', 'users.id')
        ->select('users.user_type', DB::raw("count(ewp_overall_report.profile_id) as studentcount"))
        ->where('users.user_type', '=', 'student')
        ->groupBy('users.user_type')
            ->get();

        $overallsurvey = Reports::join('users', 'ewp_overall_report.profile_id', '=', 'users.id')
        ->select(DB::raw("count(ewp_overall_report.profile_id) as overallcount"))
        ->get();


        $overall = Profile::join('users', 'profiles.user_id', '=', 'users.id')
        ->select(DB::raw("jsonb_array_elements(ptj)->>'desc' as ptj_desc, count(*) as count"))
        ->groupBy('ptj_desc')
        ->get();
    #===============================================================================#



        if(in_array(1, $roles) || in_array(2, $roles) || in_array(3, $roles)){
            return view('ewp::dashboards.admin_dash',compact('assign','put','put2','put3','results','overallsurvey','studentsurvey','staffsurvey','overall'));
        }
        else{
            return redirect()->to(route('ewp.dashboards.index'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ewp::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
        return view('ewp::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
