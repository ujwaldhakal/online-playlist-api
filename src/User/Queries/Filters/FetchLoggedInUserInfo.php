<?php

namespace OP\User\Queries\Filters;

use Illuminate\Database\ConnectionInterface;
use OP\Services\Read\Queries\Filters\AbstractFilter;
use OP\Services\Read\ReadInterface;

class FetchLoggedInUserInfo extends AbstractFilter
{

    protected $allowedParams = [
        'fields',
    ];
    protected $allowedFields = [
        'id',
        'name',
        'email'
    ];

}
