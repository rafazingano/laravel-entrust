<?php

namespace ConfrariaWeb\Entrust\Models;

use ConfrariaWeb\Entrust\Scopes\AccountRoleScope;
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
        'account_id',
    ];

    protected $casts = [
        'settings' => 'collection'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new RoleOrderByScope);
        static::addGlobalScope(new AccountRoleScope);
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('cw_entrust.roles_table');
    }

    public function permissions()
    {
        return $this->belongsToMany('ConfrariaWeb\Entrust\Models\Permission', Config::get('cw_entrust.permission_role_table'));
    }

    public function users()
    {
        return $this->belongsToMany('App\User', Config::get('cw_entrust.role_user_table'));
    }

}
