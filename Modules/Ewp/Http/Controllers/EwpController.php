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
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->where('status', 'O')->where('category', 'LIKE', '%ST%')->first();
        }
        elseif($usertype == 'student'){
            //REFER SCHEDULES BASED ON STUDENT TYPE (UG, PG, PASUM)
            //TRY EXPLODE FOR whereIN to work
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->where('status', 'O')
                                                                                                    ->where('category', 'LIKE', '%UG%')
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
        ->with('profile.user')->with('assign')
        ->where('profile_id', $profiles['id'])
        ->orderBy('id', 'asc')
        ->paginate($limit);

        //dd($profiles);

        session()->put('url.intended', url()->current());

        return view('ewp::dashboards.dashboard', compact('reports', 'schedules'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    }

    public function assignReports()
    {
        // Count the number of unassigned reports
        $unassignedCount = Answers::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('ewp_assign')
                ->whereColumn('ewp_assign.report_id', '=', 'ewp_answer.report_id');
        })->count();

        // If there are no unassigned reports, return a message
        if ($unassignedCount == 0) {
            return redirect()->back()->with('toast_error', 'No unassigned reports found.');
        }

        // Get the number of officers
        $officerCount = User::role([5])->orderBy('name', 'desc')->count();

        // If there are no officers, return a message
        if ($officerCount == 0) {
            return redirect()->back()->with('toast_error', 'No officers found.');
        }

        // Calculate the number of reports each officer should be assigned
        $reportsPerOfficer = ceil($unassignedCount / $officerCount);

        // Get a random selection of unassigned reports
        $unassignedReports = Answers::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('ewp_assign')
                ->whereColumn('ewp_assign.report_id', '=', 'ewp_answer.report_id');
        })->inRandomOrder()->limit($unassignedCount)->get();

        // Assign the reports to officers
        $officerIndex = 0;
        foreach ($unassignedReports as $report) {
            $officer = User::role([5])->orderBy('name', 'desc')->skip($officerIndex)->first();
            $assign = Assign::updateOrCreate([
                'report_id' => $report->report_id,
                'officer_id' => $officer->id,
            ]);
            $officerIndex = ($officerIndex + 1) % $officerCount;
        }

        // Return a success message
        return redirect()->back()->with('toast_success', 'Reports assigned to officers.');
    }


    public function adminindex(Request $request)
    {   
        $roles = auth()->user()->roles->pluck('id')->toArray();
        $selectedYear = $request->query('year', date('Y'));
        #====================================Pengiraan purata Interview khursus dan Umum================================#
        $results = Reports::join('users', 'ewp_overall_report.profile_id', '=', 'users.id')
        ->where('users.user_type', '=', 'staff')
        ->selectRaw("scale->'A'->'status'->>'intervention' as intervention")
        ->whereRaw("scale->'A'->'status'->>'intervention' = 'INTERVENSI KHUSUS'")
        ->whereYear('ewp_overall_report.created_at', '=', $selectedYear)
        ->count();

        $results2 = Reports::join('users', 'ewp_overall_report.profile_id', '=', 'users.id')
        ->where('users.user_type', '=', 'student')
        ->selectRaw("scale->'A'->'status'->>'intervention' as intervention")
        ->whereRaw("scale->'A'->'status'->>'intervention' = 'INTERVENSI KHUSUS'")
        ->whereYear('ewp_overall_report.created_at', '=', $selectedYear)
        ->count();

        $totalresult = $results + $results2;
        #===============================================================================================================#  

        $unassignedCount = Answers::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
            ->from('ewp_assign')
            ->whereColumn('ewp_assign.report_id', '=',
                'ewp_answer.report_id'
            );
        })->count();

        #=========================Info Officer based on student=========================#       
        $assign = User::role([5])
        ->orderBy('name', 'desc')
        ->with(['get_assign' => function ($query) use ($selectedYear) {
            $query->whereYear('created_at', $selectedYear);
        }])
            ->with('total_assign')
            ->get();

            //dd($assign);

     #===============================================================================#

    #-------------------Total Semua User untuk student and staff--------------------#
        // Get staff survey count for selected year
        $staffsurvey = Reports::join('users', 'ewp_overall_report.profile_id', '=', 'users.id')
            ->where('users.user_type', '=', 'staff')
            ->whereYear('ewp_overall_report.created_at', '=', $selectedYear)
            ->count();

        // Get student survey count for selected year
        $studentsurvey = Reports::join('users', 'ewp_overall_report.profile_id', '=', 'users.id')
            ->where('users.user_type', '=', 'student')
            ->whereYear('ewp_overall_report.created_at', '=', $selectedYear)
            ->count();

        // Get overall survey count for selected year
        $overallsurvey = Reports::selectRaw('COUNT(profile_id) AS overallcount')
            ->whereYear('created_at', '=', $selectedYear)
            ->get();


            $overall = Profile::join('ewp_overall_report', 'profiles.user_id', '=', 'ewp_overall_report.profile_id')
            ->leftJoin('users', 'profiles.user_id', '=', 'users.id')
            ->whereYear('ewp_overall_report.created_at', '=', $selectedYear)
            ->select(
                DB::raw("jsonb_array_elements(ptj)->>'desc' as ptj_desc"),
                DB::raw("count(*) as count"),
                DB::raw("SUM(CASE WHEN users.user_type = 'student' THEN 1 ELSE 0 END) as student_count"),
                DB::raw("SUM(CASE WHEN users.user_type = 'staff' THEN 1 ELSE 0 END) as staff_count")
            )
            ->groupBy('ptj_desc')
            ->get();

    #===============================================================================#
    
            #=========================statisic user============================#    
            $data['total_student'] = $data['total_staff']= $data['total_user']= 0;

            $totalsemuapelajar = User::where('user_type','=','student')
                                       ->get()
                                       ->count();
            if($totalsemuapelajar > 0){
                $data['total_student'] = $totalsemuapelajar;
            }

            #total staff
            $totalsemuastaff = User::where('user_type','=','staff')
                                    ->get()
                                    ->count();
            if($totalsemuastaff > 0){
                $data['total_staff'] = $totalsemuastaff;
            }

            $data['total_user'] = $data['total_student'] + $data['total_staff'];
            #=========================statisic user============================#  

        #============================statisic survey=========================#    



        if(in_array(1, $roles) || in_array(2, $roles) || in_array(3, $roles) || in_array(5, $roles)){
            return view('ewp::dashboards.admin_dash', compact('assign','data', 'results', 'results2', 'totalresult', 'overallsurvey', 'studentsurvey', 'staffsurvey', 'overall', 'data','selectedYear', 'unassignedCount'));
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
