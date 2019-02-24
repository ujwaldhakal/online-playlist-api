<?php

namespace OP\Authentication\Entities;

use OP\Services\AbstractWriteModel;

class User extends AbstractWriteModel
{
    protected $connection;
    protected $collection;

    public function useDefaultTable()
    {
        return $this->connection->table($this->getDefaultTableName());
    }

    public function getDefaultTableName()
    {
        return USERS_TABLE;
    }
}
