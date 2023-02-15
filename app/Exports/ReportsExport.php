<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Modules\Ewp\Entities\{Lookups, Reports, Schedules, Answers};
use Modules\Site\Entities\{Profile, User};


class ReportsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    {
        return view('ewp::assign.exceldata', [
            'reports' => Reports::all(), 
            'minmax' => Lookups::where('key', 'category')->get(),
            'officers' => User::role([5])->get()

        ]); 
    }
}
