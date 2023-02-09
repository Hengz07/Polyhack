<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;

use Modules\Ewp\Entities\{Reports, Schedules, Answers};
use Modules\Site\Entities\{Profile, User};

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

        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', 'AK')->first();

        //SCHEDULES RETRIEVE
        $usertype = auth()->user()->user_type;

        if($usertype == 'staff'){
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->whereIn('category', ['ST'])->first();
        }
        elseif($usertype == 'student'){
            //REFER SCHEDULES BASED ON STUDENT TYPE (UG, PG, PASUM)
            //TRY EXPLODE FOR whereIN to work
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->whereIn('category', ['UG'])->first();
        }

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

    public function adminindex()
    {
        $roles = auth()->user()->roles->pluck('id')->toArray();

        if(in_array(1, $roles) || in_array(2, $roles) || in_array(3, $roles)){
            return view('ewp::dashboards.admin_dash');
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