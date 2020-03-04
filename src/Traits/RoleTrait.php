<?php

namespace ConfrariaWeb\Entrust\Traits;

trait RoleTrait
{
    public function permissions()
    {
        return $this->belongsToMany('ConfrariaWeb\Entrust\Models\Permission');
    }

    public function users()
    {
        return $this->belongsToMany('ConfrariaWeb\User\Models\User');
    }

    public function steps()
    {
        return $this->belongsToMany('ConfrariaWeb\Crm\Models\Step', 'crm_role_step', 'role_id', 'step_id');
    }

    public function stepWhenCreatingUser()
    {
        return $this->belongsToMany('ConfrariaWeb\Crm\Models\Step', 'entrust_role_step_when_creating_user', 'role_id', 'step_id');
    }
}
