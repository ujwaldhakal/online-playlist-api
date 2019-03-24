<?php

namespace OP\Room\Queries;

use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionInterface;
use OP\Room\Queries\Alias\FetchRoomsAlias;
use OP\Room\Queries\Filters\FetchRoomsFilter;
use OP\Services\Read\ReadInterface;

class FetchRooms implements ReadInterface
{
    private $records;
    private $connection;
    private $filter;

    public function __construct(ConnectionInterface $connection, FetchRoomsFilter $filter)
    {
        $alias = new FetchRoomsAlias();
        $this->connection = $connection;

        $this->filter = $filter;

        $this->records = $this->queryRooms()
            ->selectRaw($alias->generate($this->filter->getFields()))
            ->get();
    }

    private function queryRooms()
    {
        $query = $this->connection->table(ROOMS_TABLE);

        if ($this->filter->shouldFilterById()) {
            $query = $query->where(ROOMS_TABLE . '.id', $this->filter->getId());
        }

        return $query;
    }

    public function get()
    {
        return $this->records;
    }
}
