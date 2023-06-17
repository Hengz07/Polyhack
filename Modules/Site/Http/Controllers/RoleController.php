<?php
namespace Modules\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\Site\Entities\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $baseView = 'site::roles';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 20;
        $search = $request->has('q') ? $request->get('q') : null;

        $roles = Role::where(function ($query) use ($search) {
            if ($search != null) {
                $query->where('name', 'like', '%' . $search . '%');
            }
        })->orderBy('level', 'asc')->paginate($limit);
        session()->put('url.intended', url()->current());
        return $this->view([$this->baseView, 'index'], compact('roles'))->with('i', ($request->input('page', 1) - 1) * $limit)->with('q', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::whereNull('parent_id')->with(['children'])->get();
        return $this->view([$this->baseView, 'create'], compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
            'level' => 'required', 
        ]);

        $role = Role::create(['name' => $request->input('name'), 'description' => $request->input('description'), 'level' => $request->input('level')]);
        
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('site.roles.index')->with('toast_success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::whereNull('parent_id')->with(['children'])->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        session()->put('url.intended', url()->previous());
        return $this->view([$this->baseView, 'edit'], compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->description = $request->input('description');
        $role->level = $request->input('level');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->intended('/')->with('toast_success', 'Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userHasThisRole = DB::table('model_has_roles')->where('role_id', $id)->count();

        if ($userHasThisRole > 0) {
            return redirect()->back()->with('toast_error', "Couldn't delete this record");
        } else {
            DB::table("roles")->where('id', $id)->delete();
            // return response()->json(true);
            return redirect()->back()->with('toast_success', "Role deleted successfully");
        }
    }
}