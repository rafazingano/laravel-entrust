<?php

namespace ConfrariaWeb\Entrust\Scopes;


use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RoleUsersScope implements Scope
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
/*
            $userAdmin = DB::table('users')
                ->select('users.id', 'roles.name')
                ->join('role_user AS role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->where(['users.id' => 127, 'roles.name' => 'admin'])
                ->exists();

            $builder->when(!$userAdmin, function ($query) {
                return $query->orderBy('roles.id');
            }, function ($query) {

                $userRoles = DB::table('roles')
                    ->join('role_user', 'role_user.role_id', '=', 'roles.id')
                    ->where('role_user.user_id', 127)
                    //->groupBy('roles.id')
                ;

                $IdUserRoles = $userRoles->pluck('roles.id');

                return $query

                    ->join('role_allowed_role', function ($join) {
                        $join->on('role_allowed_role.role_allowed_id', '=', 'roles.id')
                            ->orOn('role_allowed_role.role_allowed_id', '=', 'roles.id');
                    })
                    //->join('role_allowed_role AS role_allowed_role_scope', 'role_allowed_role_scope.role_allowed_id', '=', 'roles.id')
                    ->whereIn('role_allowed_role.role_id', $IdUserRoles)
                    //->whereNotIn('role_allowed_role.role_allowed_id', $IdUserRoles)
                    //->unionAll($userRoles)
                    //->distinct('roles.id')
                    ->groupBy('roles.id')
                    ;
            });
*/
        }

    }
}
