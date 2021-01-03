<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    /**
     * A user may have multiple roles.
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_role_user', 'user_id', 'role_id');
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     *
     * @return mixed
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            AdminRole::whereName($role)->firstOrFail()
        );
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        if (is_array($role)) {
            foreach ($role as $r) {
                if ($this->hasRole($r)) {
                    return true;
                }
            }

            return false;
        }

        return !!$role->intersect($this->roles)->count();
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  AdminPermission $permission
     *
     * @return boolean
     */
    public function hasPermission(AdminPermission $permission)
    {
        return $this->hasRole($permission->roles);
    }
}
