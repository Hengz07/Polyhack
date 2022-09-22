<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\Questions;

class QuestionsController extends Controller
{
    protected $baseView = 'ewp::setup.questions';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
       
        $limit = 20;
        $search = $request->has('q') ? $request->get('q') : null;

        $questions = Questions::where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('ewp_desc_bm', 'like', '%' . $search . '%');
            }
        })->orderBy('id', 'asc')->paginate($limit);
        session()->put('url.intended', url()->current());
        return view('ewp::setup.questions.index', compact('questions'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    
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
