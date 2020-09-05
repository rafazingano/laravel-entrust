<?php

namespace ConfrariaWeb\Entrust\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;

class AccountRoleScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!app()->runningInConsole() && existsAccount()) {
            $builder->where(function ($query) {
                $query->where(Config::get('cw_entrust.roles_table') . '.account_id', Auth::user()->account_id)
                    ->orWhereNull(Config::get('cw_entrust.roles_table') . '.account_id');
            });
        }
    }
}
