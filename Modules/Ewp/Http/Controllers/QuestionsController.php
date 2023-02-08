<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\Lookups;

class QuestionsController extends Controller
{
    protected $baseView = 'ewp::setup.questions';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $limit = 10;
        $search = $request->has('q') ? $request->get('q') : null;

        $questions = Lookups::where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('value_local', 'like', '%' . $search . '%');
            }
        })
        ->orWhere('key', 'like', 'questions')
        ->orderBy('id', 'asc')
        ->paginate($limit);
        session()->put('url.intended', url()->current());
         
        return view('ewp::setup.questions.index', compact('questions'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ewp::setup.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $code              = $request->input('code');
        $value_local       = $request->input('value_local');
        $value_translation = $request->input('value_translation');
        $desc              = $request->input('desc');
        $category          = $request->input('category');

        $x                 = explode('-',$category);
        $order             = $request->input('order');

        $status = [
            "status" => "Y",
            "name" => $x[1],
            "code" => $x[0],
            "order" => $order,
            "version" => "1"
        ];
        
        $items = [
            'key'         => 'questions',
            'code'        => $code,
            'value_local' => $value_local,
            'value_translation' => $value_translation,
            'desc' => $desc,
            'meta_value' => json_encode($status)
            // 'created_by'  => Auth::user()->id,
        ];

        $result = Lookups::updateOrCreate(['code' => $code, 'value_local' => $value_local, 'value_translation' => $value_translation, 'desc' => $desc],$items);
            
        return redirect()->route('ewp.setup.questions')->with('toast_success', 'Question has been successfully created.');
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
        $questions = Lookups::findOrFail($id)
                                ->where('id', $id)
                                ->first();

        // dd($questions);

        $meta = json_decode($questions->meta_value, true);

        $results = Lookups::select('value_local', 'id','code')
                            ->where('key', 'category')
                            ->orderBy('value_local')->get();

        foreach ($results as $result) {
            $array[] = $result->code . ' - ' . $result->value_local;
        }
        $route = $questions->key;

        return view('ewp::setup.questions.edit', compact('questions', 'meta', 'route', 'array'));
        
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $code               = $request->input('code');
        $value_local        = $request->input('value_local');
        $value_translation  = $request->input('value_translation');
        $desc               = $request->input('desc');
        $category           = $request->input('category');
        $x                  = explode('-',$category);
        $order              = $request->input('order');
        
        // dd($request);

        $status = [
            "status"  => "Y",
            "name"    => $x[1],
            "code"    => $x[0],
            "order"   => $order,
            "version" => "1"
        ];

        $items = [
            // 'key'         => $value_local,
            'code'              => $code,
            'value_local'       => $value_local,
            'value_translation' => $value_translation,
            'desc'              => $desc,
            'meta_value'        => json_encode($status)
            // 'created_by'  => Auth::user()->id,
        ];

        $result =  Lookups::updateOrCreate(['id' => $id],$items);
        return redirect()->route('ewp.setup.questions', ['route' => $result->key])->with('toast_success', $result->key . ' has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $questions = Lookups::findOrFail($id)->where('key', 'questions');
        $key = $questions->key;
        $questions->delete();
        return redirect()->route('ewp.setup.questions.index', ['route' => $key])
            ->with('toast_success', $key .' Successfully deleted!');
    }
    
}