<?php

namespace Modules\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Site\Entities\SystemConfig;

class SystemConfigController extends Controller
{
    protected $baseView = 'site::system_configs';

    /**
     * Display a listing of the resource and form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $systemConfigs = SystemConfig::all();
        $config['maintenance'] = null;
        $config['meetingPrefix'] = null;
        $config['meetingLabelNo'] = null;
        $config['meetingLabelYear'] = null;
        foreach ($systemConfigs as $systemConfig) {
            switch ($systemConfig->item) {
                case config('constants.maintenance') : $config['maintenance'] = $systemConfig->value;break;
                case config('constants.meeting_prefix') : $config['meetingPrefix'] = $systemConfig->value;break;
                case config('constants.meeting_label_no') : $config['meetingLabelNo'] = $systemConfig->value;break;
                case config('constants.meeting_label_year') : $config['meetingLabelYear'] = $systemConfig->value;break;
            }
        }
        return $this->view([$this->baseView, 'index'], compact('config'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $input['config']['maintenance'] = isset($input['config']['maintenance']) ?? 0;
        foreach ($input['config'] as $key => $value) {
            $config = SystemConfig::find($key);
            $config->value = $value;
            $config->save();
        }
        return back()->with('toast_success', 'Config saved successfully');
    }
}
