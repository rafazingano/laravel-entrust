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
            $idRoles = DB::table('roles')
                ->select('roles.id')
                ->join('role_allowed_role', function ($join) {
                    $join->on('roles.id', '=', 'role_allowed_role.role_allowed_id')
                        ->orOn('roles.id', '=', 'role_allowed_role.role_id');
                })
                ->leftJoin('role_user', 'role_allowed_role.role_id', '=', 'role_user.role_id')
                ->where('role_user.user_id', Auth::id())
                ->groupBy('roles.id')
                ->pluck('roles.id');
            $builder->whereIn('roles.id', $idRoles);
        }

    }
}
