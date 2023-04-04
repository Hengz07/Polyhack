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
                Role::create(['id' => 5, 'module_id' => null, 'name' => 'EwpOfficer', 'description' => 'Ewp Officer', 'level' => 5]);
        
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

            $aktif = 'AK';

            //---------------------------------------------------------------//
            
            //STAFF 1
            
            $userstaff1 = User::create([
                'name' => 'MUHAMMAD HABIEL WAFI BIN ZAIRI',
                'email' => 'habiel@um.edu.my',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'staff',
            ]);

            $userstaff1->profile()->updateOrCreate(['user_id' => $userstaff1->id], [
                'user_id' => '1',
                'profile_no' => '000835049',
                'status' => $aktif,
                'ptj' => 
                [
                    'code' => 'FCS',
                    'desc' => 'Faculty of Computer Science' 
                ],
                'department' => 
                [
                    'code' => 'CSAI',
                    'desc' => 'Computer Science (AI)' 
                ],
                'meta' => 
                [
                    'gender' => 'Male',
                    'race' => 'Malaysian',
                    'hp_no' => '0122894017',
                    'office_no' => '03456789',
                ]
            ]);

            //STAFF 2

            $userstaff2 = User::create([
                'name' => 'HAMI HELMI BIN ALIAS',
                'email' => 'hami@um.edu.my',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'staff',
            ]);

            $userstaff2->profile()->updateOrCreate(['user_id' => $userstaff2->id], [
                'user_id' => '2',
                'profile_no' => '000958467',
                'status' => $aktif,
                'ptj' => 
                [
                    'code' => 'FCS',
                    'desc' => 'Faculty of Computer Science' 
                ],
                'department' => 
                [
                    'code' => 'IT',
                    'desc' => 'Information Technology' 
                ],
                'meta' => 
                [
                    'gender' => 'Male',
                    'race' => 'Malaysian',
                    'hp_no' => '0195749358',
                    'office_no' => '03854392',
                ]
            ]);

            //STAFF 3

            $userstaff3 = User::create([
                'name' => 'ABDUL HADI BIN YAHAYA',
                'email' => 'hadi@um.edu.my',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'staff',
            ]);

            $userstaff3->profile()->updateOrCreate(['user_id' => $userstaff3->id], [
                'user_id' => '3',
                'profile_no' => '000862642',
                'status' => $aktif,
                'ptj' => 
                [
                    'code' => 'FCS',
                    'desc' => 'Faculty of Computer Science' 
                ],
                'department' => 
                [
                    'code' => 'CS',
                    'desc' => 'Computer Science' 
                ],
                'meta' => 
                [
                    'gender' => 'Male',
                    'race' => 'Malaysian',
                    'hp_no' => '0129584325',
                    'office_no' => '03895832',
                ]
            ]);

            //---------------------------------------------------------------//

            //STUD 1

            $userstud1 = User::create([
                'name' => 'AHMAD HAFIZUL ILMI BIN AHMAD KHAIRI',
                'email' => 'hafizul@siswa.um.edu.my',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'student',
            ]);
            
            $userstud1->profile()->updateOrCreate(['user_id' => $userstud1->id], [
                'user_id' => '4',
                'profile_no' => '000638236',
                'status' => $aktif,
                'ptj' => 
                [
                    'code' => 'FCST',
                    'desc' => 'Faculty of Computer Science and Technology'
                ],
                'department' => 
                [
                    'code' => 'CSN',
                    'desc' => 'Computer Science (Netcentric)' 
                ],
                'meta' => 
                [
                    'gender' => 'Male',
                    'race' => 'Malaysian',
                    'hp_no' => '0123456789',
                    'office_no' => '',
                ]
            ]);

            //STUD 2

            $userstud2 = User::create([
                'name' => 'WAN MUHAMMAD SYAMIL BIN WAN MOHAMAD NOOR',
                'email' => 'syamil@siswa.um.edu.my',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'student',
            ]);
            
            $userstud2->profile()->updateOrCreate(['user_id' => $userstud2->id], [
                'user_id' => '5',
                'profile_no' => '000859345',
                'status' => $aktif,
                'ptj' => 
                [
                    'code' => 'FCST',
                    'desc' => 'Faculty of Accounting' 
                ],
                'department' => 
                [
                    'code' => 'AC',
                    'desc' => 'Accounting'
                ],
                'meta' => 
                [
                    'gender' => 'Male', 
                    'race' => 'Malaysian', 
                    'hp_no' => '0129738527', 
                    'office_no' => '', 
                ] 
            ]); 

            //---------------------------------------------------------------//

            //OFFICER 1

            $userofficer1 = User::create([ 
                'name' => 'TUN MOHD ALAMIN BIN TUN ABD MANAN', 
                'email' => 'tunamin@um.edu.my', 
                'password' => bcrypt('abcd1234'), 
                'user_type' => 'staff', 
            ]); 
            
            $userofficer1->profile()->updateOrCreate(['user_id' => $userofficer1->id], [
                'user_id' => '6', 
                'profile_no' => '00014987', 
                'status' => $aktif, 
                'department' => 
                [
                    'code' => 'Section of Psychology Management & Counseling',
                    'desc' => '-' 
                ],
                'meta' => 
                [
                    'gender' => 'Male',
                    'race' => 'Malaysian',
                    'hp_no' => '',
                    'office_no' => '',
                ]
            ]);

            //OFFICER 2

            $userofficer2 = User::create([
                'name' => 'MUHAMMAD NABIL BIN MALIP',
                'email' => 'nabil@um.edu.my',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'staff',
            ]);
            
            $userofficer2->profile()->updateOrCreate(['user_id' => $userofficer2->id], [
                'user_id' => '7',
                'profile_no' => '000234515',
                'status' => $aktif,
                'department' => 
                [
                    'code' => 'Section of Psychology Management & Counseling',
                    'desc' => '-'
                ],
                'meta' => 
                [
                    'gender' => 'Male',
                    'race' => 'Malaysian',
                    'hp_no' => '',
                    'office_no' => '',
                ]
            ]);
            
            $userstaff1->assignRole([$role->id,config('constants.role.siteAdmin')]);
            $userstaff2->assignRole([$role->id,config('constants.role.normalUser')]);
            $userstaff3->assignRole([$role->id,config('constants.role.normalUser')]);
            $userstud1->assignRole([$role->id,config('constants.role.normalUser')]);
            $userstud2->assignRole([$role->id,config('constants.role.normalUser')]);
            $userofficer1->assignRole([$role->id,config('constants.role.ewpOfficer')]);
            $userofficer2->assignRole([$role->id,config('constants.role.ewpOfficer')]);
        // }
    }
}
