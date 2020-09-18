<?php

namespace ConfrariaWeb\Acl\Traits;

use Illuminate\Support\Facades\Config;

trait AclUserTrait
{
    public function roles()
    {
        return $this->belongsToMany(Config::get('cw_acl.role'), Config::get('cw_acl.role_user_table'), Config::get('cw_acl.user_foreign_key'));
    }

    public function permissions()
    {
        return $this->hasManyDeep(
            Config::get('cw_acl.permission'),
            [Config::get('cw_acl.role_user_table'), Config::get('cw_acl.role'), Config::get('cw_acl.permission_role_table')]
        );
    }

    public function hasRole($role)
    {
        return ($this->isAdmin() || $this->roles->contains('name', $role));
    }

    public function hasPermission($permission)
    {
        return ($this->isAdmin() || $this->permissions->contains('name', $permission));
    }
}
