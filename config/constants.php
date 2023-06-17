<?php

return [

    /**
     * ROLE MANAGEMENT
     */

    ## LIST ROLE IN THE SYSTEM
    'role_list' => ['Superadmin', 'SiteAdmin', 'ModuleAdmin', 'NormalUser', 'EwpOfficer'],
    'role_top' => ['Superadmin', 'SiteAdmin'],

    ## ROLE NAME
    ## MAKE SURE IT MATCH WITH THE DATABASE
    'role' => [
        'superadmin'        => 'Superadmin',
        'siteAdmin'         => 'SiteAdmin',
        'moduleAdmin'       => 'ModuleAdmin',
        'normalUser'        => 'NormalUser',
        'ewpOfficer'        => 'EwpOfficer',
    ],

    ## ROLE ID
    ## MAKE SURE IT MATCH WITH THE DATABASE
    'role_id' => [
        'superadmin'        => 1,
        'siteAdmin'         => 2,
        'moduleAdmin'       => 3,
        'normalUser'        => 4,
        'ewpOfficer'        => 5,
    ],
    /** END ROLE MANAGEMENT */

    ## MODEL
    'model_type' => [
        'faculty' => [
            'level' => 1, 
            'name' => 'faculty', 
            'model' => 'Modules\Site\Entities\Ptj', 
        ],
        'department' => [
            'level' => 2, 
            'name' => 'department', 
            'model' => 'Modules\Site\Entities\Department', 
        ],
        'division' => [
            'level' => 3, 
            'name' => 'division', 
            'model' => 'Modules\Site\Entities\Division', 
        ],
        'section' => [
            'level' => 4, 
            'name' => 'section', 
            'model' => 'Modules\Site\Entities\Section', 
        ],
        'unit' => [
            'level' => 5, 
            'name' => 'unit', 
            'model' => 'Modules\Site\Entities\Unit', 
        ],
    ],

    ## LIST DATA PER PAGE
    'pagination_records'    => 20,

    ## SYSTEM CONFIG
    'maintenance' => 'maintenance', 

    ## FILE
    'file_allow_type' => [
        'doc'       => ['pdf'],
        'image'     => ['jpg', 'png', 'jpeg'],
    ],
    'file_max_size' => 2048,


    ## MONTH
    'months' => [
        1 => 'Jan', 
        2 => 'Feb', 
        3 => 'Mac',
        4 => 'Apr',
        5 => 'May',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Aug',
        9 => 'Sep',
        10 => 'Oct',
        11 => 'Nov',
        12 => 'Dis',
    ],
];
?>