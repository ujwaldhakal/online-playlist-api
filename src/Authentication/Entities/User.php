<?php

namespace OP\Authentication\Entities;

use OP\Services\AbstractWriteModel;

class User extends AbstractWriteModel implements UserInterface
{
    protected $connection;
    protected $collection;

    public function __construct()
    {
        $this->connection;
    }

    public function useDefaultTable()
    {
        return $this->connection->table($this->getDefaultTableName());
    }

    public function findByEmail($email)
    {
        return $this->findWhere('email', $email);
    }

    public function getDefaultTableName()
    {
        return USERS_TABLE;
    }
}
