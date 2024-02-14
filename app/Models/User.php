<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Arr;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    private $permissionsCache; // related user permissions cache
    private $rolesCache;       // related user role cache

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id');
    }

    public function hasRole($roleName)
    {
        //mysql (utf8mb4_unicode_ci) is case insensitive
        if (empty($this->rolesCache)) {
            $this->rolesCache = $this->roles->map(function ($item, $key) {
                                        $item->name = strtolower($item->name);
                                        return $item;
                                    });
        }
        $roleName = strtolower($roleName);

        return $this->rolesCache->where("name", $roleName)->isNotEmpty();
    }

    public function hasPermission($moduleName, $access = null)
    {
        // do not check for permission if the user is admin
        if ($this->hasRole('admin')) {
            return TRUE;
        }

        if (empty(Module::$cache)) {
            Module::$cache = Module::all()->map(function ($item, $key) {
                                    $item->name = strtolower($item->name);
                                    return $item;
                                });
        }

        $module         = Module::$cache->where('name', strtolower($moduleName))->first();
        $module_id      = empty($module) ? null : $module->id;
        $permissions    = $this->permissions();

        if (empty($module_id) || $permissions->isEmpty()) {
            return FALSE;
        }
        $result     = $permissions->where('module_id', $module_id);

        if (!empty($access)) {
            $result = $result->where('access', strtolower($access));
        }

        if (!$result->isEmpty()) {
            return TRUE;
        }

        return FALSE;
    }

    private function permissions()
    {
        if (empty($this->permissionsCache)) {
            $this->permissionsCache = $this->roles->load("permissions")->pluck("permissions")
                                                ->collapse()->map(function ($item, $key) {
                                                    $item->access = strtolower($item->access);
                                                    return $item;
                                                });
        }
        return $this->permissionsCache;
    }

    public static function havingRole($role, $value = 'id', $key = 'id')
    {
        $role   = Arr::wrap($role);
        $users  = User::wherehas('roles', function ($query) use ($role) {
                            $query->whereIn('name', $role);
                        });

        return $users->pluck($value, $key)->toArray();
    }
}
