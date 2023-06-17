<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Site\Entities\SystemConfig;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'item' => 'maintenance', 
                'value' => 0, 
            ],
        
        ];

        foreach ($items as $item) {
            SystemConfig::create($item);
        }
    }
}