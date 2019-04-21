<?php

namespace OP\User\Queries\Alias;

use OP\Services\Read\Queries\Alias\AbstractAlias;

class FetchLoggedInUserInfo extends AbstractAlias
{
    protected $alias = [
        'id' => USERS_TABLE . '.id',
        'email' => USERS_TABLE . '.email'
    ];
}
