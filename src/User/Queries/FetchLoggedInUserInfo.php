<?php

namespace OP\User\Queries;

use Illuminate\Database\ConnectionInterface;
use OP\Authentication\Entities\LoggedInUser;
use OP\Services\Read\ReadInterface;
use OP\User\Queries\Filters\FetchLoggedInUserInfo as FetchLoggedInUserInfoFilter;
use OP\User\Queries\Alias\FetchLoggedInUserInfo as FetchLoggedInUserInfoAlias;

class FetchLoggedInUserInfo implements ReadInterface
{
    private $records;
    private $connection;
    private $filter;
    private $user;

    public function __construct(ConnectionInterface $connection, FetchLoggedInUserInfoFilter $filter, LoggedInUser $user)
    {
        $alias = new  FetchLoggedInUserInfoAlias();
        $this->connection = $connection;
        $this->filter = $filter;
        $this->user = $user;
        $this->records = $this->queryUserInfo()
            ->selectRaw($alias->generate($this->filter->getFields()))
            ->get();
    }

    public function get()
    {
        return $this->records;
    }

    private function queryUserInfo()
    {
        $query = $this->connection->table(USERS_TABLE);

        $query = $query->where(USERS_TABLE . '.id', $this->user->getId());

        return $query;
    }

}
