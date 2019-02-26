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


    protected function fill($data)
    {
        $this->collection = new Collection($data);
        return $this->collection;
    }

    public function findWhere($search)
    {
        $this->query = $this->useDefaultTable()->where($search);

        if (!$this->query->count()) {
            return false;
        }

        return $this->returnCollections();

    }

    protected function returnCollections()
    {
        if (!$this->query->count()) {
            return false;
        }

        return $this->query->get()->map(function ($item) {
            $class = get_called_class();
            $newClass = new $class($this->connection);
            $newClass->fill((array)$item);

            return $newClass;

        });
    }

    public function getId()
    {
        return $this->collection->get('id');
    }

}
