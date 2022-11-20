<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\Reports;
use Modules\Ewp\Entities\Schedules;
use Modules\Site\Entities\Profile;
use Modules\Site\Entities\User;

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

        //CALL FROM OTHER TABLES
        $schedules = Schedules::all();
        //

        session()->put('url.intended', url()->current());

        return view('ewp::dashboards.staff_dashboard', compact('reports', 'schedules'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $schedules = Schedules::all();
        $users = auth()->user();
        $profiles = Profile::all();

        foreach ($profiles as $profile)

        //RETRIEVE JSON/JSONB DATA
        $jsonb_ptj = $profile['ptj'];
            foreach ($jsonb_ptj as $jsonb_ptj)

        $jsonb_department = $profile['department'];
            foreach ($jsonb_department as $jsonb_department)

        $meta = $profile['meta'];
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
        $alt_email = $request->input('alt_email');
        $alt_phone = $request->input('alt_phone');

        $items = [
            'alt_email' => $alt_email,
            'alt_phone' => $alt_phone,
        ];

        Profile::updateOrCreate(['user_id' => auth()->user()->id], $items);
        
        $result  = Reports::updateOrCreate(['uuid' => auth()->user()->uuid]);
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
    
}