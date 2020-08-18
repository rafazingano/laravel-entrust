<?php

namespace ConfrariaWeb\Entrust\Models;

use ConfrariaWeb\Entrust\Scopes\RoleOrderByScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Role extends Model
{


    protected $table = 'entrust_roles';

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'settings',
    ];

    protected $casts = [
        'settings' => 'collection'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new RoleOrderByScope);
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('cw_entrust.roles_table');
    }

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
