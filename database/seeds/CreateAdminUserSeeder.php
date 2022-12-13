<?php
use Modules\Site\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Modules\Site\Entities\Module;
use Modules\Site\Entities\UserType;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Artisan::call('ptj:generate');

        // create user types
        UserType::create(['id' => 1, 'code' => 'staff', 'name' => 'Staff', 'name_my' => 'Pekerja']);
        UserType::create(['id' => 2, 'code' => 'student', 'name' => 'Student', 'name_my' => 'Pelajar']);
        UserType::create(['id' => 3, 'code' => 'public', 'name' => 'Public', 'name_my' => 'Umum']);

        // create module data
        Module::create(['id' => 1, 'code' => 'SITE', 'name' => 'Site', 'description' => 'Site system configuration']);

        // create role 
        $role = Role::create(['id' => 1, 'module_id' => 1,  'name' => 'Superadmin', 'description' => 'For Developers', 'level' => 0]);
                Role::create(['id' => 2, 'module_id' => 1, 'name' => 'SiteAdmin', 'description' => 'Site Admin', 'level' => 1]);
                Role::create(['id' => 3, 'module_id' => 1, 'name' => 'ModuleAdmin', 'description' => 'Specific Module Admin', 'level' => 2]);
                Role::create(['id' => 4, 'module_id' => 1, 'name' => 'NormalUser', 'description' => 'Public user', 'level' => 999]);
        
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        // if (env('HAS_CAS')) {
            ## create user haezal
            // $user = User::create([
            //     'name' => 'ENCIK TUN AMIN BIN MANAN',
            //     'email' => 'tunamin@um.edu.my',
            //     'password' => bcrypt('abcd1234'),
            // ]);    

            //---------------------------------------------------------------//

            $userstaff = User::create([
                'name' => 'MUHAMMAD HABIEL WAFI BIN ZAIRI',
                'email' => 'habiel@um.edu.my',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'staff',
            ]);

            $userstaff->profile()->updateOrCreate(['user_id' => $userstaff->id], [
                'user_id' => '1',
                'profile_no' => '000835049',
                'status' => 'AK',
                'ptj' => 
                [
                    [
                        'code' => 'FCS',
                        'desc' => 'Faculty of Computer Science' 
                    ]
                ],
                'department' => 
                [
                    [
                        'code' => 'CSAI',
                        'desc' => 'Computer Science (AI)' 
                    ]
                ],
                'meta' => 
                [
                    [
                        'gender' => 'Male',
                        'race' => 'Malaysian',
                        'hp_no' => '0122894017',
                        'office_no' => '03456789',
                    ]
                ]
            ]);

            //---------------------------------------------------------------//

            $userstud = User::create([
                'name' => 'AHMAD HAFIZUL ILMI BIN AHMAD KHAIRI',
                'email' => 'hafizul@siswa.um.edu.my',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'student',
            ]);

            $userstud->profile()->updateOrCreate(['user_id' => $userstud->id], [
                'user_id' => '2',
                'profile_no' => '000854429',
                'status' => 'AK',
                'ptj' => 
                [
                    [
                        'code' => 'FCST',
                        'desc' => 'Faculty of Computer Science and Technology' 
                    ]
                ],
                'department' => 
                [
                    [
                        'code' => 'CSN',
                        'desc' => 'Computer Science (Netcentric)' 
                    ]
                ],
                'meta' => 
                [
                    [
                        'gender' => 'Male',
                        'race' => 'Malaysian',
                        'hp_no' => '0123456789',
                        'office_no' => '03654068',
                    ]
                ]
            ]);
            
            $userstaff->assignRole([$role->id,config('constants.role.siteAdmin')]);
            $userstud->assignRole([$role->id,config('constants.role.normalUser')]);
        // }
    }
}
