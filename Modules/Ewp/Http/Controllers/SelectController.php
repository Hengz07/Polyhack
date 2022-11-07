<?php

//namespace App\Http\Controllers;
namespace Modules\Ewp\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Permission;
use Modules\Ewp\Entities\Lookups;
use Modules\Site\Entities\Module; //test use
use Illuminate\Http\Request;

class SelectController extends Controller
{
    /**
     * Display a listing of the departments for select dropdown.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function getCategory(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $results = Lookups::select('value_local', 'id','code')
                            ->where('key', 'category')
                            ->orderBy('value_local')->get();
        } else {
            $results = Lookups::select('value_local', 'id','code')
                            ->where('key', 'category')
                            ->where('value_local', 'ilike', '%' . $search . '%')
                            ->orderBy('value_local')->get();
        }

        $response = array();
        foreach ($results as $result) {
            $response[] = array(
                "id" => $result->id,
                "text" => $result->value_local,
                "code" => $result->code,
            );
        }

        echo json_encode($response);
        exit;
    }
}
