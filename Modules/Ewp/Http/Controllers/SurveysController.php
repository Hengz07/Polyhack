<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\{Reports, Lookups, Schedules, Answers};
use Modules\Site\Entities\Profile;

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        $question = Lookups::orderby('id', 'asc')
                    ->where('key', 'questions')->get();

        $uuid = $id;

        $schedules = Schedules::orderBy('id', 'asc')->get();
    
        return view('ewp::survey.index',compact('question', 'schedules','uuid'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id)
    {
        $schedules = Schedules::findOrFail($id);

        return view('ewp::create', compact('schedules'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $survey = $request->input();
        // dd($survey['q']);

        $items = [
            'meta' => $survey
        ];

        Answers::updateOrCreate(['report_id' => $survey['id']], $items);

        return true;
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
