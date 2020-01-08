<?php

namespace ConfrariaWeb\Entrust\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Permission extends Model
{

    protected $table = 'entrust_permissions';

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    public function __construct()
    {
        $this->table = Config::get('cw_entrust.permissions_table');
    }

}
