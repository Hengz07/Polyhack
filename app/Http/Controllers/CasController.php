<?php

namespace App\Http\Controllers;

use App\Events\ManageUserLocal;
use Subfission\Cas\Facades\Cas;
use function App\Helpers\ldap;
use Modules\Site\Entities\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CasController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Cas::authenticate();
        $email = Cas::getUser();

        ## GET STAFF PROFILE FROM API URL/hris/staff/profile/v2/{secureId}
        $tmp = explode('@', $email);

        ## GET NO GAJI FROM EMAIL
        $ldap = ldap($tmp[0], $tmp[1]);
        
        if ($ldap['status']) {
            $ldapBody = $ldap['body'];

            $user = UserModel::where('email', $email)->first();

            if ($user) {
                Auth::loginUsingId($user->id);
                Log::info('Showing the user profile for user: '.$user->id);
            }
        }
        else {
            abort(500, 'Error LDAP');
        }
        return redirect()->route('home');
    }

    public function authenticated() {
       
        if (!Cas::isAuthenticated())
            return view('authenticated');
            // Cas::authenticate();
        return view('authenticated');
    }
}
