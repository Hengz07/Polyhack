<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\Lookups;

class ScalesController extends Controller
{
    protected $baseView = 'ewp::setup.scale';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        
        $limit = 5;
        $search = $request->has('q') ? $request->get('q') : null;

        $scales = Lookups::where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('value_local', 'like', '%' . $search . '%');
            }
        })
        ->where('key', 'like', 'scales')
        ->orderBy('id', 'asc')->paginate($limit);
        
        $category = Lookups::where('key', 'category')
        ->get();

        session()->put('url.intended', url()->current());
        
        return view('ewp::setup.scale.index', compact('scales', 'category'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ewp::setup.scale.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $code        = $request->input('code');
        $value_local = $request->input('value_local');
        $value_translation = $request->input('value_translation');
        $desc         = $request->input('desc');
        
        $items = [
            'key'         => "scales",
            'code'        => $code,
            'value_local' => $value_local,
            'value_translation' => $value_translation,
            'desc' => $desc,
        ];

        //KEY - CATEGORY
        $name = $request->input('name');
        $min  = $request->input('min');
        $max  = $request->input('max');
        
        $range = [
            'name' => $name,
            'min' => $min,
            'max' => $max
            // 'created_by'  => Auth::user()->id,
        ];

        $metaitem = [
            'meta_value' => json_encode($range)
        ];

        $result = Lookups::updateOrCreate(['code' => $code],$items, $metaitem);
            
        return redirect()->route('setup.scale')->with('toast_success', 'Scale has been successfully created.');
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
        $scales   = Lookups::findOrFail($id);
        $category = Lookups::findOrFail($id);

        $meta = json_decode($category->meta_value, true);
        //dd($meta_value);

        $route = $scales->key;

        return view('ewp::setup.scale.edit', compact('scales', 'category', 'meta', 'route'));
        
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $range = $request->input('value');
        // dd($array_save);

        $item = [
            'meta_value' => json_encode($range)
        ];

        $result =  Lookups::updateOrCreate(['id' => $id], $item);

        return redirect()->route('setup.scale', ['route' => $result->key])->with('toast_success', $result->key . ' has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $scales = Lookups::findOrFail($id);
        $key = $scales->key;
        $scales->delete();
        return redirect()->route('ewp.setup.scale.index', ['route' => $key])
            ->with('toast_success', $key .' Successfully deleted!');
    }
    
}