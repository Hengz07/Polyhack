<?php

namespace Modules\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Site\Entities\Permission;

class PermissionController extends Controller
{
    protected $baseView = 'site::permissions';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 20;
        $search = $request->has('q') ? $request->get('q') : null;

        $permissions = Permission::whereNull('parent_id')->with('children')->where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('name', 'like', '%' . $search . '%');
            }

        })->orderBy('id', 'asc')->paginate($limit);
        session()->flash('backUrl', $request->fullUrl());
        return $this->view([$this->baseView, 'index'], compact('permissions'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    }

    public function create() {
        if (session()->has('backUrl')) {
            session()->keep('backUrl');
        }
        $permissions = Permission::whereNull('parent_id')->orderby('name', 'asc')->pluck('name', 'id')->all();
        return $this->view([$this->baseView, 'create'])->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Permission::create($request->all());

        return ($url = session()->get('backUrl')) 
            ? redirect($url)->with('toast_success', 'Permission successfully updated!')
            : redirect()->route('site.permissions.index')->with('toast_success', 'Permission successfully updated!');
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Permission created successfully',
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roleHasPermission = DB::table('role_has_permissions')->where('permission_id', $id)->count();

        if ($roleHasPermission > 0) {
            $type = 'warning';
            $message = 'Permission unsuccessfully deleted';
        }
        else {
            Permission::find($id)->delete();
            Permission::where('parent_id', $id)->delete();
            $type = 'success';
            $message = 'Permission successfully deleted';
        }

        return ($url = session()->get('backUrl')) 
            ? redirect($url)->with($type, $message)
            : redirect()->route('site.permissions.index')->with($type, $message);
    }
}