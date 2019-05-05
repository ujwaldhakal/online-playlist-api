<?php

namespace OP\Room\Queries\Filters;

use OP\Services\Read\Queries\Filters\AbstractFilter;

class FetchRoomsFilter extends AbstractFilter
{
    protected $allowedParams = [
        'fields',
        'id',
        'slug'
    ];
    protected $allowedFields = [
        'id',
        'name',
        'description',
        'dj_id',
        'created_at',
        'slug'
    ];

    public function shouldFilterBySlug()
    {
        return !empty($this->getSlug());
    }

    public function getSlug()
    {
        return $this->getParams('slug');
    }
}
