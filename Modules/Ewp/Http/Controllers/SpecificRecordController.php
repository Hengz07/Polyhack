<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\{Reports, Schedules, Answers, Assign, Lookups};
use Modules\Site\Entities\{Profile, User};

use Modules\Ewp\Http\Controllers\ReportsController;

class SpecificRecordController extends Controller
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

        return view('ewp::specialrecord.index', compact('reports', 'officers'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
    **/
    public function create()
    {
        $issue = Lookups::where('key', 'issue')->get();
        $status = Lookups::where('key', 'status')->get();
        $refer = Lookups::where('key', 'refer')->get();

        // dd($issue);
        
        return view('ewp::specialrecord.create', compact('issue', 'status', 'refer'));
    }
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        
        
        return redirect()->route('ewp.specialrecord.index')->with('toast_success', 'Student have been assigned!');
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


        return view('ewp::setup.schedules.edit', compact('schedules', 'route'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $session    = $request->input('session');
        $semester   = $request->input('semester');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');
        $status     = 'C';

        //ARRAY TO STRING
        $catarray   = collect($request->input('category'));
            $category = $catarray->implode(', ');

        // $sdformat = Carbon::createFromFormat('Y-m-d', $start_date)->format('d-m-Y');
        // $edformat = Carbon::createFromFormat('Y-m-d', $end_date)->format('d-m-Y');
        
        $items = [
            'session'    => $session,
            'semester'   => $semester,
            'category'   => $category,
            'status'     => $status,
            'start_date' => $start_date,
            'end_date'   => $end_date
        ];

        $result = Schedules::updateOrCreate(['id' => $id], $items);

        return redirect()->route('ewp.setup.schedules', ['route' => $result->id])->with('toast_success', 'Schedule has been successfully updated.');
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