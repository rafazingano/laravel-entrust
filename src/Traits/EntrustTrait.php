<?php

namespace ConfrariaWeb\Entrust\Traits;

use Illuminate\Support\Facades\Config;

trait EntrustTrait
{
    public function roles()
    {
        return $this->belongsToMany(Config::get('cw_entrust.role'), Config::get('cw_entrust.role_user_table'), Config::get('cw_entrust.user_foreign_key'));
    }

    public function permissions()
    {
        return $this->hasManyDeep(
            Config::get('cw_entrust.permission'),
            [Config::get('cw_entrust.role_user_table'), Config::get('cw_entrust.role'), Config::get('cw_entrust.permission_role_table')]
        );
    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    public function hasPermission($permission)
    {
        return ($this->roles->contains('name', 'administrator') || $this->permissions->contains('name', $permission));
    }
}
