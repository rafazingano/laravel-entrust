<?php

namespace ConfrariaWeb\Entrust\Traits;

trait RoleTrait
{

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

    public function permissions()
    {
        return $this->belongsToMany('ConfrariaWeb\Entrust\Models\Permission');
    }

    public function users()
    {
        return $this->belongsToMany('ConfrariaWeb\User\Models\User');
    }




}
