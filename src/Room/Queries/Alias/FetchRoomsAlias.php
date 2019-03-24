<?php

namespace OP\Room\Queries\Alias;

use OP\Services\Read\Queries\Alias\AbstractAlias;

class FetchRoomsAlias extends AbstractAlias
{
    protected $alias = [
        'id' => ROOMS_TABLE . '.id',
        'name' => ROOMS_TABLE . '.name',
        'slug' => ROOMS_TABLE . '.slug',
        'description' => ROOMS_TABLE . '.description',
        'created_at' => ROOMS_TABLE . '.created_at',
        'updated_at' => ROOMS_TABLE . '.updated_at',
        'dj_id' => ROOMS_TABLE . '.dj_id',
        'dj_name' => USERS_TABLE.'.name'
    ];

}
