<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

use Modules\Ewp\Entities\Schedules;

class SchedulesController extends Controller
{
    protected $baseView = 'ewp::setup.schedules';
    /**
     * Display a listing of the resource.
     * @return Renderable
     * 
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
        
        //STATUS IF CURRENT DATE IN BETWEEN START AND END DATE
        $open = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->get();

        foreach ($open as $o);

        $stat = '';

        if(count($open) != 0)
        {
            $statusitem = [
                'status' => 'O'
            ];

            Schedules::updateOrCreate(['id' => $o['id']], $statusitem);
        }

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
            'end_date'   => $end_date,
        ];

        $result = Schedules::updateOrCreate(['session' => $session, 'semester' => $semester, 'category' => $category, 'start_date' => $start_date, 'end_date' => $end_date, 'status' => $status], $items);
            
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
        $schedules = Schedules::findOrFail($id);
        $id = $schedules->id;
        $schedules->delete();
        return redirect()->route('ewp.setup.schedules.index', ['route' => $schedules])
            ->with('toast_success', $schedules .' Successfully deleted!');
    }
    
}