<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Ewp\Entities\{Reports, Lookups, Schedules, Answers};
use Modules\Site\Entities\{Profile, User};

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

        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', 'AK')->first();
        $check = Reports::where('uuid', $id)->where('profile_id', $profiles['id'])->first();
        
        if(!empty($check)){

            if($check['status'] == 'V'){
                return view('ewp::survey.index',compact('question', 'schedules', 'uuid'));
            }
            elseif($check['status'] == 'C'){
                return redirect()->route('ewp.dashboards.index')->with('toast_success', 'Survey was already answered');
            }
        }
        else{
            return redirect()->route('ewp.dashboards.index')->with('toast_warning', 'Data not available.');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id)
    {
        return view('ewp::create');
    }

    /** q   
     * Store a newly created resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function store(Request $request)
    {
        //OTHER TABLES
        $profiles  = Profile::where('user_id', auth()->user()->id)->where('status', 'AK')->first();
        $reports   = Reports::where('profile_id', $profiles['id'])->first();

        //SCHEDULES RETRIEVE
        $usertype  = auth()->user()->user_type;

        if($usertype == 'staff'){
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->whereIn('category', ['ST'])->first();
        }
        elseif($usertype == 'student'){
            //REFER SCHEDULES BASED ON STUDENT TYPE (UG, PG, PASUM)
            $schedules = Schedules::where('start_date', '<=', now())->where('end_date', '>=', now())->whereIn('category', ['UG', 'PG', 'PASUM'])->first();
        }
        //

        $survey = $request->input();
        $session = $schedules['session'];
        $sem = $schedules['semester'];  

        $currdate = now();

        $items = [
            'meta' => $survey,
            'session' => $session,
            'date_taken' => $currdate,
            'sem' => $sem
        ];

        $status = $reports['status'];
        
        $result = $this->calculation($survey);

        // dd($result);

        $status = [
            'status' => 'C',
            'scale' => json_encode($result)
        ];

        Answers::updateOrCreate(['report_id' => $reports['id'], 'session' => $session, 'sem' => $sem], $items);
        Reports::updateOrCreate(['id' => $reports['id']], $status);  


        return true;
    }

    public function calculation($info)
    {
        $answers = json_decode($info['q']);

        $td = $ta = $ts = 0; 
        $d = $a = $s = 0;

        foreach($answers as $key => $name)
        {
            $data = current((array)$name);
            $arr = str_split($data);

            if($arr[2] == 'D'){
                $type[$arr[2]]['value'] = $d += $name->value;
                $type[$arr[2]]['total'] = $td += 3;
            }
            elseif($arr[2] == 'A'){
                $type[$arr[2]]['value'] = $a += $name->value;
                $type[$arr[2]]['total'] = $ta += 3;
            }
            elseif($arr[2] == 'S'){
                $type[$arr[2]]['value'] = $s += $name->value;
                $type[$arr[2]]['total'] = $ts += 3;
            }
        }

        $category = Lookups::where('key', 'category')->get();
        return $this->get_scale_status($type, $category);
    }

    public function answers($id)
    {
        
    }

    public function get_scale_intersive($info)
    {
        // for($i = 0; $i < 3; $i++)
        // {
        //     if($info['D'] == true) 
        //     {
        //         if($info['D']['status']['name'] == 'TERUK' || $info['D']['status']['name'] == 'SANGAT TERUK')
        //         {
        //             $info['D']['status']['intersive'] = 'INTERVENSI KHUSUS';
        //         }
        //         else
        //         {
        //             $info['D']['status']['intersive'] = 'INTERVENSI UMUM';
        //         }
        //     }

        //     elseif($info['A'] == true) 
        //     {
        //         if($info['A']['status']['name'] == 'TERUK' || $info['A']['status']['name'] == 'SANGAT TERUK')
        //         {
        //             $info['A']['status']['intersive'] = 'INTERVENSI KHUSUS';
        //         }
        //         else
        //         {
        //             $info['A']['status']['intersive'] = 'INTERVENSI UMUM';
        //         }
        //     }

        //     elseif($info['S'] == true) 
        //     {
        //         if($info['S']['status']['name'] == 'TERUK' || $info['S']['status']['name'] == 'SANGAT TERUK')
        //         {
        //             $info['S']['status']['intersive'] = 'INTERVENSI KHUSUS';
        //         }
        //         else
        //         {
        //             $info['S']['status']['intersive'] = 'INTERVENSI UMUM';
        //         }
        //     }
        // }

        // dd($info);
    }

    //DALAM INFO HANTAR VALUE UNTUK DAPATKAN CATEGORY
    public function get_scale_status($info, $category)
    {
        //CARI SCALE (1 - 5)
        //CARI CATEGORY (NORMAL, TAK NORMAL)

        foreach($category as $key => $cat)
        {
            $status = json_decode($cat['meta_value']); 

            if($cat['code'] == 'D')
            {
                foreach($status as $stats)
                {
                    if($info['D']['value'] >= $stats->min && $info['D']['value'] <= $stats->max)
                    {
                        $info['D']['status']['name'] = $stats->name;

                        $range = array($stats->min, $stats->max);
                        $info['D']['status']['range'] = implode(' - ', $range); //USE IMPLODE HERE

                        if($info['D']['status']['name'] == 'TERUK' || $info['D']['status']['name'] == 'SANGAT TERUK')
                        {
                            $info['D']['status']['intersive'] = 'INTERVENSI KHUSUS';
                        }
                        else
                        {
                            $info['D']['status']['intersive'] = 'INTERVENSI UMUM';
                        }
                    }
                }
            }

            elseif($cat['code'] == 'A')
            {
                foreach($status as $stats)
                {
                    if($info['A']['value'] >= $stats->min && $info['A']['value'] <= $stats->max)
                    {
                        $info['A']['status']['name'] = $stats->name;

                        $range = array($stats->min, $stats->max);
                        $info['A']['status']['range'] = implode(' - ', $range); //USE IMPLODE HERE

                        if($info['A']['status']['name'] == 'TERUK' || $info['A']['status']['name'] == 'SANGAT TERUK')
                        {
                            $info['A']['status']['intersive'] = 'INTERVENSI KHUSUS';
                        }
                        else
                        {
                            $info['A']['status']['intersive'] = 'INTERVENSI UMUM';
                        }
                    }
                }
            }

            elseif($cat['code'] == 'S')
            {
                foreach($status as $stats)
                {
                    if($info['S']['value'] >= $stats->min && $info['S']['value'] <= $stats->max)
                    {
                        $info['S']['status']['name'] = $stats->name;

                        $range = array($stats->min, $stats->max);
                        $info['S']['status']['range'] = implode(' - ', $range); //USE IMPLODE HERE
                        
                        if($info['S']['status']['name'] == 'TERUK' || $info['S']['status']['name'] == 'SANGAT TERUK')
                        {
                            $info['S']['status']['intersive'] = 'INTERVENSI KHUSUS';
                        }
                        else
                        {
                            $info['S']['status']['intersive'] = 'INTERVENSI UMUM';
                        }
                    }
                }
            }
        }

        return $info;
        //RETURN CATEGORY
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
