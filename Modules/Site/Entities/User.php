<?php
namespace Modules\Site\Entities;

use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Fleet\Entities\User as FleetUser;
use Modules\Ewp\Entities\Assign;
use Illuminate\Support\Facades\DB;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use function App\Helpers\camelCase;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasFactory;
    
    protected $fillable = [
        'name', 'email', 'password', 'user_type',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            // $query->created_by = auth()->user()->id;
            // $query->updated_by = auth()->user()->id;
        });
        
        static::updating(function ($query) {
            // $query->updated_by = auth()->user()->id;
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-M-Y h:i A');
    }

    public function ptj() {
        return $this->belongsTo('Modules\Site\Entities\Ptj');
    }

    public function department() {
        return $this->belongsTo('Modules\Site\Entities\Department');
    }

    public function assign()
    { 
        return $this->hasOne('Modules\Ewp\Entities\Assign', 'officer_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function schedules()
    {
        return $this->hasMany('Modules\Ewp\Entities\Schedules');
    }

    ## FLEET 
    public function fleetAdmins() {
        return $this->hasMany(FleetUser::class, 'user_id')->where('role_id', config('constants.role_id.fleetDeptAdmin'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    
    public function get_assign(){
        return $this->hasMany(Assign::class, 'officer_id')->whereIn('status', ['S', 'R', 'B']);
    }

    public function total_assign()
    {
        return $this->hasMany(Assign::class, 'officer_id')
        ->select('officer_id', DB::raw('count(*) as total_count'))
            ->groupBy('officer_id');
    }

    public function get_total(){
        return $this->hasMany(Assign::class, 'user_type')->whereIn('user_type', ['staff','student']);
    }
}