<?php

namespace ConfrariaWeb\Entrust\Models;

use ConfrariaWeb\Entrust\Scopes\RoleAllowedScope;
use ConfrariaWeb\Entrust\Scopes\RoleUsersScope;
use ConfrariaWeb\Entrust\Scopes\RoleOrderByScope;
use ConfrariaWeb\Option\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Role extends Model
{

    use OptionTrait;

    protected $table = 'entrust_roles';

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'settings'
    ];

    protected $casts = [
        'settings' => 'collection'
    ];

    public function __construct()
    {
        $this->table = Config::get('cw_entrust.entrust_roles');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new RoleOrderByScope);
        static::addGlobalScope(new RoleAllowedScope);
    }

    public function permissions()
    {
        return $this->belongsToMany('ConfrariaWeb\Entrust\Models\Permission');
    }

    public function users()
    {
        return $this->belongsToMany('ConfrariaWeb\user\Models\User');
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
        return $this->belongsToMany('ConfrariaWeb\Entrust\Models\Role', 'entrust_role_allowed_role', 'role_id', 'role_allowed_id');
    }

    public function allowedRoles()
    {
        return $this->belongsToMany('ConfrariaWeb\Entrust\Models\Role', 'entrust_role_allowed_role', 'role_id', 'role_allowed_id');
    }

    /**
     * Relaciona os status disponiveis para usuarios deste perfil.
     * Ao criar um novo usuario, os statuses disponiveis para o mesmo vem desta relação
     */
    public function usersStatuses()
    {
        return $this->belongsToMany('App\Status', 'entrust_role_status_user');
    }

    /**
     * Relaciona os status disponiveis para tarefas deste perfil.
     * Ao criar uma tarefa o status para a mesma vem desta relação.
     */
    public function tasksStatuses()
    {
        return $this->belongsToMany('App\Status', 'entrust_role_status_task');
    }

    /**
     * Relaciona a Fase com o perfil aos ser criada uma pessoa com este perfil.
     */
    public function stepWhenCreatingUser()
    {
        return $this->belongsToMany('App\Step', 'entrust_role_step_when_creating_user');
    }


}
