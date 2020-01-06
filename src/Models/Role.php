<?php

namespace ConfrariaWeb\Entrust\Models;

use ConfrariaWeb\Entrust\Scopes\RoleAllowedScope;
use ConfrariaWeb\Entrust\Scopes\RoleUsersScope;
use ConfrariaWeb\Entrust\Scopes\RoleOrderByScope;
use Illuminate\Database\Eloquent\Model;
use ConfrariaWeb\Option\Traits\OptionTrait;

class Role extends Model
{

    use OptionTrait;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'settings'
    ];

    protected $casts = [
        'settings' => 'collection'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new RoleUsersScope);
        static::addGlobalScope(new RoleOrderByScope);
        static::addGlobalScope(new RoleAllowedScope);
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function steps()
    {
        return $this->belongsToMany('App\Step');
    }

    /**
     * Relaciona os perfis disponiveis para usuarios deste perfil.
     * Ao criar um novo usuario, os perfis disponiveis para o mesmo vem desta relação
     */
    public function usersRoles()
    {
        return $this->belongsToMany('App\Role', 'role_allowed_role', 'role_id', 'role_allowed_id');
    }

    public function allowedRoles()
    {
        return $this->belongsToMany('App\Role', 'role_allowed_role', 'role_id', 'role_allowed_id');
    }

    /**
     * Relaciona os status disponiveis para usuarios deste perfil.
     * Ao criar um novo usuario, os statuses disponiveis para o mesmo vem desta relação
     */
    public function usersStatuses()
    {
        return $this->belongsToMany('App\Status', 'role_status_user');
    }

    /**
     * Relaciona os status disponiveis para tarefas deste perfil.
     * Ao criar uma tarefa o status para a mesma vem desta relação.
     */
    public function tasksStatuses()
    {
        return $this->belongsToMany('App\Status', 'role_status_task');
    }

    /**
     * Relaciona a Fase com o perfil aos ser criada uma pessoa com este perfil.
     */
    public function stepWhenCreatingUser()
    {
        return $this->belongsToMany('App\Step', 'role_step_when_creating_user');
    }


}