<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\Schedules;

class SchedulesController extends Controller
{
    protected $baseView = 'ewp::setup.schedules';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $limit = 10;
        $search = $request->has('q') ? $request->get('q') : null;

        $schedules = Schedules::where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('session', 'like', '%' . $search . '%')
                        ->orWhere('semester', 'like', '%' . $search . '%')
                        ->orWhere('category', 'like', '%' . $search . '%');
            }
        })
        
        ->orderBy('id', 'asc')->paginate($limit);
        session()->put('url.intended', url()->current());
         
        return view('ewp::setup.schedules.index', compact('schedules'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ewp::setup.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $session    = $request->input('session');
        $semester   = $request->input('semester');
        $category   = $request->input('category');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');
        
        $items = [
            'session'    => $session,
            'semester'   => $semester,
            'category'   => $category,
            'start_date' => $start_date,
            'end_date'   => $end_date
        ];

        $result = Schedules::updateOrCreate(['session' => $session, 'semester' => $semester, 'category' => $category ], $items);
            
        return redirect()->route('ewp.setup.schedules')->with('toast_success', 'Schedule has been successfully created.');
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
        $schedules = Schedules::findOrFail($id);

        $route = $schedules->id;

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
        $category   = $request->input('category');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');
        
        $items = [
            'session'    => $session,
            'semester'   => $semester,
            'category'   => $category,
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
        $schedules = Schedules::findOrFail($id);
        $id = $schedules->id;
        $schedules->delete();
        return redirect()->route('ewp.setup.schedules.index', ['route' => $schedules])
            ->with('toast_success', $schedules .' Successfully deleted!');
    }
    
}