<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\{Reports, Schedules, Answers, Assign};
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

        return view('ewp::assign.index', compact('reports', 'officers'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    
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
        $officer_id = intval($request->input('officer'));
        
        foreach ($report_id as $reportid => $rep_id)
        {
            $status = [
                'report_id'  => $rep_id,
                'officer_id' => $officer_id  
            ];
            
            $result = Assign::updateOrCreate(['report_id' => $report_id], $status);
        }

        $all = Assign::get();

        dd($all);
                
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
        $assign = Assign::findOrFail($id);
        $key = $assign->key;
        $assign->delete();
        return redirect()->route('ewp.setup.questions.index', ['route' => $key])  
            ->with('toast_success', $key .' Successfully deleted!');
    }

    public function information()
    {
        $reports = Reports::with('profile.user')->with('assign')
        ->orderBy('profile_id', 'asc')
        ->orderBy('session', 'asc')
        ->orderBy('sem', 'asc')
        ->get();
        
        foreach($reports as $rep){

            $profile = $rep['profile'];
            $user = $profile['user'];

            $scale = json_decode($rep['scale'], true);
            $meta = $profile['meta'][0];
            $ptj = $profile['ptj'][0];
            $department = $profile['department'][0];
        }

        return view('ewp::assign.information', compact('rep', 'profile', 'user', 'scale', 'meta', 'ptj', 'department'));
    }
    
}