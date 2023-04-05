<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;

use Modules\Ewp\Entities\{Reports, Schedules, Answers, Assign, Lookups};
use Modules\Site\Entities\{Profile, User};
use Illuminate\Support\Facades\DB;
use Modules\Ewp\Http\Controllers\ReportsController;

class AssignController extends Controller
{
    // protected $baseView = '';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {   
        $limit = 10;
        $search = $request->has('q') ? $request->get('q') : null;
        
        $s_session = $request->has('session') ? $request->get('session') : null; 
        $s_semester = $request->has('semester') ? $request->get('semester') : null; 
        $s_faculty = $request->has('faculty') ? $request->get('faculty') : null; 
        $s_status = $request->has('status') ? $request->get('status') : null; 
        $s_officer = $request->has('officer') ? $request->get('officer') : null; 

        $results = DB::table('ewp_overall_report')
                        ->selectRaw("scale->'A'->'status'->>'intervention' as intervention")
                        ->get();
        // dd($results);
        

        $usertype = $request->input('status');

        $reports = Reports::with('profile.user', 'assign', 'profile')
            ->where(function ($query) use ($search, $s_session, $s_semester, $s_officer, $s_faculty, $s_status) {
                if($search != null){
                    $query->whereHas('profile.user', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                }
                if ($s_faculty != null) {
                    $query->whereHas('profile', function ($query) use ($s_faculty) {
                        $query->where('ptj', 'like', '%' . $s_faculty . '%');
                    });
                }
                if($s_officer != null){
                    $query->whereHas('assign', function($query) use ($s_officer){
                       $query->where('officer_id', $s_officer);
                    });
                }

                if ($s_status != null) {
                    $query->whereRaw("scale->'A'->'status'->>'intervention' = ?", [$s_status]);
                }
                if ($s_session != null){
                    $query->where('session', $s_session);
                }
                if ($s_semester != null){
                    $query->where('sem', $s_semester);
                }
            })
        ->orderBy('profile_id', 'asc')
        ->orderBy('session', 'asc')
        ->orderBy('sem', 'asc')
        ->paginate($limit); 
        // dd($s_faculty);

        $officers = User::role([5])->get();

        $minmax = Lookups::where('key', 'category')->get();

        return view('ewp::assign.index', compact('results','reports', 'officers', 'minmax', 's_session', 's_semester', 's_officer', 's_status', 's_faculty'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search)->with('officer', $s_officer)->with('faculty', $s_faculty)->with('session', $s_session)->with('semester', $s_semester);
    }

    public function specificrecordindex(Request $request)
    {
        $limit = 10;
        $search = $request->has('q') ? $request->get('q') : null;
        
        $s_session = $request->has('session') ? $request->get('session') : null; 
        $s_semester = $request->has('semester') ? $request->get('semester') : null; 
        $s_faculty = $request->has('faculty') ? $request->get('faculty') : null; 
        $s_status = $request->has('status') ? $request->get('status') : null; 
        $s_officer = $request->has('officer') ? $request->get('officer') : null; 

        $usertype = $request->input('status');

        $reports = Reports::with('profile.user')->with('assign')
            ->where(function ($query) use ($search, $s_session, $s_semester, $s_officer, $s_faculty, $s_status) {
                if($search != null){
                    $query->whereHas('profile.user', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                }
                if($s_officer != null){
                    $query->whereHas('assign', function($query) use ($s_officer){
                       $query->where('officer_id', $s_officer);
                    });
                }
                if ($s_status != null) {
                    $query->whereRaw("scale->'A'->'status'->>'intervention' = ?", [$s_status]);
                }
                if ($s_session != null){
                    $query->where('session', $s_session);
                }
                if ($s_semester != null){
                    $query->where('sem', $s_semester);
                }
                if($s_faculty != null){
                    $query->whereHas('profile', function($query) use ($s_faculty){
                        // dd($query->get());
                        $query->where('ptj', $s_faculty);
                    });
                }
            })
        ->orderBy('profile_id', 'asc')
        ->orderBy('session', 'asc')
        ->orderBy('sem', 'asc')
        ->paginate($limit);
        

        $officers = User::role([5])->get();

        $minmax = Lookups::where('key', 'category')->get();

        return view('ewp::assign.specificrecordindex', compact('reports', 'officers', 'minmax', 's_session', 's_semester', 's_officer', 's_status', 's_faculty'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search)->with('officer', $s_officer)->with('faculty', $s_faculty)->with('session', $s_session)->with('semester', $s_semester);
    }

    public function assignsearching(Request $request)
    {
        $limit = 10;
        $search = $request->has('q') ? $request->get('q') : null;

        $reports = Reports::with('profile.user')->with('assign')->where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('session', 'like', '%' . $search . '%')
                      ->orWhere('sem', 'like', '%' . $search . '%');
            }
        })
        ->orderBy('profile_id', 'asc')
        ->orderBy('session', 'asc')
        ->orderBy('sem', 'asc')
        ->paginate($limit);

        $officers = User::role([5])->get();

        $minmax = Lookups::where('key', 'category')->get();

        return view('ewp::assign.assignsearching', compact('reports', 'officers', 'minmax'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
    **/
    public function create()
    {
        return view('ewp::assign.create');
    }
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $report_id  = explode(',', $request->input('sid'));
        $officer_id = $request->input('officer');
        
        foreach ($report_id as $rep_id) 
        {
            $check = Assign::where('report_id', $rep_id)->first();

            if(empty($check))
            {
                $status = [
                    'report_id'  => $rep_id,
                    'officer_id' => $officer_id
                ];
                
                $result = Assign::updateOrCreate(['officer_id' => $officer_id, 'report_id' => $rep_id], $status);
            }
            else
            {
                $status = [
                    'report_id'  => $rep_id,
                    'officer_id' => $officer_id
                ];

                Assign::updateOrCreate(['id' => $check->id], $status);
            }
        }
        
        return redirect()->route('ewp.assign.index')->with('toast_success', 'Student have been assigned!');
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
        $issue  = Lookups::where('key', 'issue')->get();
        $status = Lookups::where('key', 'status')->get();
        $refer  = Lookups::where('key', 'refer')->get();
 
        $assign = Assign::where('report_id', $id)->first();

        $assignmeta = json_decode($assign['meta'], true);
        
        return view('ewp::assign.edit', compact('issue', 'status', 'refer', 'id', 'assignmeta', 'assign'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $report_id = $id;
        $status    = substr($request->input('status'), 0, 1);
        $comment   = $request->input('comment');

        $issuearr     = collect($request->input('issue'));
            $issue    = $issuearr->implode(', ');
        $referarr     = collect($request->input('refer'));
            $refer    = $referarr->implode(', ');

        $meta = [
            "issue"   => $issue,
            "refer"   => $refer,
            "comment" => $comment,
        ];

        $status = [
            "status" => $status,
            "meta"   => json_encode($meta, true),
        ];

        $result = Assign::updateOrCreate(['report_id' => $report_id], $status);
        
        return redirect()->route('ewp.assign.specificrecordindex')->with('toast_success', "Student's summary has been created!");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $assign = Assign::findOrFail($id);
        $key = $assign->key;
        $assign->delete();
        return redirect()->route('ewp.setup.questions.index', ['route' => $key])  
            ->with('toast_success', $key .' Successfully deleted!');
    }

    public function saringaninfo($id)
    {
        $report = Reports::with('profile.user')->with('assign')->where('id', $id)->first();

        $profile = $report['profile'];
        $user = $profile['user'];
        
        $meta = $profile['meta'];
        $ptj = $profile['ptj'];
        $department = $profile['department'];

        $route = $report->id;
        
        return view('ewp::assign.saringaninfo', compact('report', 'route', 'user', 'profile', 'meta', 'ptj', 'department'));
    }

    public function surveyanswer($id)
    {
        $report = Reports::with('profile.user')->with('assign')->with('answer')->where('id', $id)->first();
        $question = Lookups::where('key', 'questions')->orderBy('code')->get();

        $answer = $report['answer'];

        $q = $answer['meta']['q'];

        $meta = json_decode($q, true);

        $profile = $report['profile'];
        $user = $profile['user'];
        
        $route = $report->id;
        
        return view('ewp::assign.surveyanswer', compact('report', 'question', 'answer', 'route', 'user', 'profile', 'meta'));
    }
    
    public function exportRep()
    {
        return Excel::download(new ReportsExport, 'userreport.xlsx');
    }

    public function exceldata(Request $request)
    {
        $s_session = $request->has('session') ? $request->get('session') : null;
        $s_semester = $request->has('semester') ? $request->get('semester') : null;
        $s_faculty = $request->has('faculty') ? $request->get('faculty') : null;
        $s_status = $request->has('status') ? $request->get('status') : null;
        $s_officer = $request->has('officer') ? $request->get('officer') : null;

        $search = $request->has('q') ? $request->get('q') : null;

        $reports = Reports::with('profile.user', 'assign', 'profile')
        ->where(function ($query) use ($search, $s_session, $s_semester, $s_officer, $s_faculty, $s_status) {
            if ($search != null) {
                $query->whereHas('profile.user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            }
            if ($s_faculty != null) {
                $query->whereHas('profile', function ($query) use ($s_faculty) {
                    $query->where('ptj', 'like', '%' . $s_faculty . '%');
                });
            }
            if ($s_officer != null) {
                $query->whereHas('assign', function ($query) use ($s_officer) {
                    $query->where('officer_id', $s_officer);
                });
            }

            if ($s_status != null) {
                $query->whereRaw("scale->'A'->'status'->>'intervention' = ?", [$s_status]);
            }
            if ($s_session != null) {
                $query->where('session', $s_session);
            }
            if ($s_semester != null) {
                $query->where('sem', $s_semester);
            }
        })
        ->orderBy('profile_id', 'asc')
        ->orderBy('session', 'asc')
        ->orderBy('sem', 'asc');

        $officers = User::role([5])->get();

        $minmax = Lookups::where('key', 'category')->get();

        return view('ewp::assign.exceldata', compact('reports', 'officers', 'minmax'));
    
    }
}