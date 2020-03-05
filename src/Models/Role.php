<?php

namespace ConfrariaWeb\Entrust\Models;

use ConfrariaWeb\Entrust\Scopes\RoleOrderByScope;
use ConfrariaWeb\Entrust\Traits\RoleTrait;
use ConfrariaWeb\Option\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Role extends Model
{
    use RoleTrait;
    use OptionTrait;

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

}
