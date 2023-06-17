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
        $Superadmin = Role::create(['id' => 1, 'module_id' => 1,  'name' => 'Superadmin', 'description' => 'For Developers', 'level' => 0]);
        $SiteAdmin = Role::create(['id' => 2, 'module_id' => 1, 'name' => 'SiteAdmin', 'description' => 'Site Admin', 'level' => 1]);
        $ModuleAdmin = Role::create(['id' => 3, 'module_id' => 1, 'name' => 'ModuleAdmin', 'description' => 'Specific Module Admin', 'level' => 2]);
        $NormalUser = Role::create(['id' => 4, 'module_id' => 1, 'name' => 'NormalUser', 'description' => 'Public user', 'level' => 999]);
        $EwpOfficer = Role::create(['id' => 5, 'module_id' => null, 'name' => 'EwpOfficer', 'description' => 'Ewp Officer', 'level' => 5]);
        
        $permissions = Permission::pluck('id', 'id')->all();
        $upermissions = Permission::where('id', 9)->pluck('id')->first();

        $EwpOfficer->syncPermissions($permissions);
        $NormalUser->syncPermissions($upermissions);

            //---------------------------------------------------------------//

            $aktif = 'AK';

            //STUD 1

            $userstud1 = User::create([
                'name' => 'User 1',
                'email' => 'user1@polyhack2023.com',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'student',
            ]);
            
            $userstud1->profile()->updateOrCreate(['user_id' => $userstud1->id], [
                'user_id' => '4',
                'profile_no' => '000638236',
                'status' => $aktif,
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
                'name' => 'User 2',
                'email' => 'user2@polyhack2023.com',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'student',
            ]);
            
            $userstud2->profile()->updateOrCreate(['user_id' => $userstud2->id], [
                'user_id' => '5',
                'profile_no' => '000859345',
                'status' => $aktif,
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
                'name' => 'Polyhack Admin 1', 
                'email' => 'admin1@polyhack2023.com', 
                'password' => bcrypt('abcd1234'), 
                'user_type' => 'staff', 
            ]); 
            
            $userofficer1->profile()->updateOrCreate(['user_id' => $userofficer1->id], [
                'user_id' => '6', 
                'profile_no' => '00014987', 
                'status' => $aktif,
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
                'name' => 'Polyhack Admin 2',
                'email' => 'admin2@polyhack2023.com',
                'password' => bcrypt('abcd1234'),
                'user_type' => 'staff',
            ]);
            
            $userofficer2->profile()->updateOrCreate(['user_id' => $userofficer2->id], [
                'user_id' => '7',
                'profile_no' => '000234515',
                'status' => $aktif,
                'meta' => 
                [
                    'gender' => 'Male',
                    'race' => 'Malaysian',
                    'hp_no' => '',
                    'office_no' => '',
                ]
            ]);

            $userstud1->assignRole([$NormalUser->id,config('constants.role.normalUser')]);
            $userstud2->assignRole([$NormalUser->id,config('constants.role.normalUser')]);
            $userofficer1->assignRole([$EwpOfficer->id,config('constants.role.ewpOfficer')]);
            $userofficer2->assignRole([$EwpOfficer->id,config('constants.role.ewpOfficer')]);
        // }
    }
}
