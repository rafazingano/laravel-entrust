<?php

namespace ConfrariaWeb\Entrust\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleAllowedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (!app()->runningInConsole()) {
            $idRoles = DB::table('entrust_roles')
                ->select('entrust_roles.id')
                ->join('entrust_role_allowed_role', function ($join) {
                    $join->on('entrust_roles.id', '=', 'entrust_role_allowed_role.role_allowed_id')
                        ->orOn('entrust_roles.id', '=', 'entrust_role_allowed_role.role_id');
                })
                ->leftJoin('entrust_role_user', 'entrust_role_allowed_role.role_id', '=', 'entrust_role_user.role_id')
                ->where('entrust_role_user.user_id', Auth::id())
                ->groupBy('entrust_roles.id')
                ->pluck('entrust_roles.id');
            $builder->whereIn('entrust_roles.id', $idRoles);
        }

    }
}
