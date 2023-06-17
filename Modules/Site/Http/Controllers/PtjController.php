<?php

namespace Modules\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\System\Ptj;
use App\Models\System\User;
use App\Models\UserAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

class PtjController extends Controller
{
    protected $baseView = 'modules.systems.org_structures.ptjs';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faculty = new Ptj();
        $limit = config('constants.pagination_records');
        $search = $request->has('q') ? $request->get('q') : null;
        $ptjs = $faculty->getFaculties($search, $limit, false);

        // get total trashed
        $trash = Ptj::onlyTrashed()->count();
        
        ## hold current page url for use in edit page
        ## to make sure after edit data, the page redirect to same pagination
        session()->put('url.intended', url()->full());
        return $this->view([$this->baseView, 'index'], compact('ptjs', 'trash'))
                    ->with('i', ($request->input('page', 1) - 1) * $limit)
                    ->with('q', $search);
    }


    /**
     * Fetch faculties record from HRIS using API.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        $response = Http::withToken(env('UMAPI_WEBSITE_TOKEN'))->get(env('UMAPI_URL'). 'lookup/faculty');   

        if ($response->status() == 200) {
            $body = json_decode($response->body());
            $insert = [];

            ## get all ID from API
            $ids = [];
            foreach ($body->data as $data) {
                $ids[] = $data->PTG_KOD_PTJ;
            }

            ## get all ID from existing table
            $currentIds = Ptj::get()->pluck('id')->toArray();

            ## not exists id from current existing table with data from API
            $deleteIds=array_diff($currentIds,$ids);

            DB::beginTransaction();
            try {
                foreach ($body->data as $key => $data) {
                    $faculty = Ptj::firstOrNew(['id' => $data->PTG_KOD_PTJ]); // insert when found new record
                    $faculty->id = $data->PTG_KOD_PTJ;
                    $faculty->short_name = $data->PTG_KTRGN_SINGKAT;
                    $faculty->name = $data->PTG_KTRGN_BI;
                    $faculty->name_malay = $data->PTG_KTRGN_PTJ;
                    $faculty->email = $data->PTG_EMAIL;
                    $faculty->is_academic = $data->PTG_STATUS == 'A' ? true:false;

                    if (!$faculty)
                        $faculty->active = ($data->PTG_AKTIF == 'Y') ? true:false;
                    $faculty->save();
                }

                ## inactive the faculty that not exists in latest from API
                foreach ($deleteIds as $deleteId) {
                    $faculty = Ptj::find($deleteId);
                    $faculty->active = false;
                    $faculty->save();
                }
                
                DB::commit();
                return redirect()->route('ptjs.index')->with('toast_success', 'Faculties fetched from HRIS successfully !');
            }
            catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('ptjs.index')->with('toast_error', $e->getMessage());
            }
        }
        else {
            $body = json_decode($response->body());
            return redirect()->route('ptjs.index')->with('toast_error', 'Error '. $response->status() . '. ' . $body->message);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAdmin(Request $request, Faculty $faculty)
    {
        $role = config('constants.role.adminFaculty');
        $modelType = config('constants.model_type.faculty');

        $roleId = Role::where('name', $role)->first();
        $input = $request->all();
        $user = User::find($input['admin-id']);
        $user->assignRole([config('constants.role.public')]);
        $user->assignRole($role);
        $insert = [
            'role_id' => $roleId->id, 
            'user_id' => $input['admin-id'], 
            'model_type' => $modelType,
            'model_id' => $faculty->id
        ];
        UserAssignment::create($insert);
        return redirect()->back()->with('toast_success', $user->name . ' successfully assign as faculty admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSecretariat(Request $request, Faculty $faculty)
    {
        $role = config('constants.role.secretariat');
        $modelType = config('constants.model_type.faculty');

        $roleId = Role::where('name', $role)->first();
        $input = $request->all();
        $user = User::find($input['secretariat-id']);
        $user->assignRole([config('constants.role.public')]);
        $user->assignRole($role);
        $insert = [
            'role_id' => $roleId->id, 
            'user_id' => $input['secretariat-id'], 
            'model_type' => $modelType,
            'model_id' => $faculty->id
        ];
        UserAssignment::create($insert);
        return redirect()->back()->with('toast_success', $user->name . ' successfully assign as faculty secretariat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        $intendedUrl = session()->get('url.intended', url('/'));

        return $this->view([$this->baseView, 'show'], compact('faculty', 'intendedUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        //
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
        //
    }

    /**
     * Update the active status the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Request $request)
    {
        if (!$request->ajax()) {
            abort(500);
        }

        $faculty = Ptj::find($request->id);
        $faculty->active = $request->active;
        $faculty->save();
        $status = ($request->active) ? ' activated!': ' inactive!';
        return response()->json([
            'status' => true, 
            'message' => $faculty->name . $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAssignment($id)
    {
        ## delete from user assignment
        $userAssignment = UserAssignment::find($id);
        $userAssignment->delete();

        ## get role information
        $role = Role::findById($userAssignment->role_id);

        ## revoke role admin faculty if this user dont have another faculty assignment
        $countUserAssignment = UserAssignment::where([
            'user_id' => $userAssignment->user_id, 
            'role_id' => $userAssignment->role_id, 
        ])->count();
        
        $user = User::find($userAssignment->user_id);
        if ($countUserAssignment == 0) {
            $user->removeRole($role->name);
        }

        return redirect()->back()->with('toast_success', $user->name . ' has been revoke as ' . $role->name);
    }
}