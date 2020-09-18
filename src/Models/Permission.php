<?php

namespace ConfrariaWeb\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Permission extends Model
{

    protected $table = 'acl_permissions';

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('cw_acl.permissions_table');
    }

    public function roles()
    {
        return $this->belongsToMany('ConfrariaWeb\Acl\Models\Role', Config::get('cw_acl.permission_role_table'));
    }

}
