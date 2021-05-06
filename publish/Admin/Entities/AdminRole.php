<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AdminRole extends Model
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];

    /**
     * The roles that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany(AdminUser::class, 'admin_role_user', 'role_id', 'user_id');
    }

    /**
     * A role may be given various permissions.
     *
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class,'admin_permission_role', 'role_id', 'permission_id');
    }

    /**
     * Grant the given permission to a role.
     *
     * @param AdminPermission $permission
     *
     * @return mixed
     */
    public function givePermissionTo(AdminPermission $permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }

    public function getActivitylogOptions()
    {
        return LogOptions::defaults();
    }
}
