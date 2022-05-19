<?php

namespace App\Console\Commands;

use App\Models\Space\Campus;
use App\Models\Space\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CopyCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy category table';

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
     * @return int
     */
    public function handle()
    {
        $sql = "select * from category where cat_del = '0'";
        $categories = DB::connection('ocsrs')->select( DB::raw($sql));
            
        foreach ($categories as $kCampus => $category) {
            $insertCampus['ocsrs_id'] = $category->cat_id;
            $insertCampus['code'] = $category->cat_code;
            $insertCampus['name'] = $category->cat_name;
            $insertCampus['name_english'] = $category->cat_name_english;
            $insertCampus['glno'] = $category->cat_glno;
            $insertCampus['accommodation'] = $category->cat_accommodation;
            $insertCampus['type'] = $category->cat_type;
            Category::create($insertCampus);
            $this->info('Data ' . $category->cat_name .' have been transfer successfully');
        }
        
    }
}
