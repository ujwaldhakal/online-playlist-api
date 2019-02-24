<?php

namespace OP\Services;

use Illuminate\Database\Connection;

abstract class AbstractWriteModel
{
    protected $connection;
    protected $collection;
    protected $query;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findbyId($id)
    {
        $this->query = $this->useDefaultTable()->where($this->getDefaultTableName() . '.id', $id);

        if (!$this->query->first()) {
            return false;
        }


        $this->fill((array)$this->query->first());

        return $this;

    }

}
