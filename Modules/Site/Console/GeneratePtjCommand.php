<?php

namespace Modules\Site\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Modules\Site\Entities\Department;
use Modules\Site\Entities\Organization;
use Modules\Site\Entities\Ptj;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GeneratePtjCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ptj:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate PTJ from API Services';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $response = Http::withToken(env('UMAPI_WEBSITE_TOKEN'))->get(env('UMAPI_URL'). 'lookup/faculty');  
        $responseDept = Http::withToken(env('UMAPI_WEBSITE_TOKEN'))->get(env('UMAPI_URL'). 'lookup/department');   
        if ($response->status() == 200 && $responseDept->status() == 200) {
            $body = json_decode($response->body());
            $bodyDept = json_decode($responseDept->body());
        
            foreach ($body->data as $ptj) {
    
                $savedPtj = Ptj::create([
                    'code' => $ptj->PTG_KOD_PTJ,
                    'short_name' => $ptj->PTG_KTRGN_SINGKAT , 
                    'name' => $ptj->PTG_KTRGN_BI, 
                    'name_my' => $ptj->PTG_KTRGN_PTJ,
                ]);

                $ptjDepts = [];
                $noDept = 1;
                foreach ($bodyDept->data as $dept) {
                    if ($dept->JBT_KOD_PTJ == $ptj->PTG_KOD_PTJ) {
                        $ptjDepts[] = $dept;

                        Department::create([
                            'code' => $dept->JBT_KOD_JABATAN,
                            'short_name' => $dept->JBT_KTRGN_SINGKAT,
                            'name' => $dept->JBT_DESC_JABATAN,
                            'name_my' => $dept->JBT_KTRGN_JABATAN,
                            'ptj_id' => $savedPtj->id, 
                        ]);                            

                        $noDept++;
                    }
                }
            }
        }
        $this->info('PTj/Departments successfully generated!!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
