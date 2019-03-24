<?php

namespace OP\Room\Queries\Filters;

use OP\Services\Read\Queries\Filters\AbstractFilter;

class FetchRoomsFilter extends AbstractFilter
{
    protected $allowedParams = [
        'fields',
        'id'
    ];
    protected $allowedFields = [
        'id',
        'name',
        'description',
        'dj_id',
        'created_at',
        'slug'
    ];

}
