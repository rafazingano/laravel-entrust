<?php

namespace ConfrariaWeb\Entrust\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;

class RoleOrderByScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!app()->runningInConsole()) {
            $builder->orderBy(Config::get('cw_entrust.roles_table') . '.display_name', 'asc');
        }
    }
}
