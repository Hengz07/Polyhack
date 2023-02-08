<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\{Reports, Schedules, Answers, Assign, Lookups};
use Modules\Site\Entities\{Profile, User};

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

        return view('ewp::assign.index', compact('reports', 'officers', 'minmax'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    
    }

    public function specificrecordindex(Request $request)
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

        return view('ewp::assign.specificrecordindex', compact('reports', 'officers', 'minmax'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
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

    public function information()
    {
        // dd($id);

        $reports = Reports::with('profile.user')->with('assign')
        ->orderBy('profile_id', 'asc')
        ->orderBy('session', 'asc')
        ->orderBy('sem', 'asc')
        ->get();
        
        // foreach($reports as $rep){
            
        //     $profile = $rep['profile'];
        //     $user = $profile['user'];

        //     $scale = $rep['scale'];
        //     $meta = $profile['meta'][0];
        //     $ptj = $profile['ptj'][0];
        //     $department = $profile['department'][0];
        // }

        return view('ewp::assign.information', compact('reports'));
    }
    
}