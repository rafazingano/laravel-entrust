<?php

namespace ConfrariaWeb\Acl\Scopes;

use Auth;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class AccountRoleScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $accountID = Cache::get('accountID');
        if (!app()->runningInConsole() && existsAccount()) {
            $builder->where(function ($query) use($accountID){
                $query->where(Config::get('cw_acl.roles_table') . '.account_id', $accountID)
                    ->orWhereNull(Config::get('cw_acl.roles_table') . '.account_id');
            });
        }
    }
}
