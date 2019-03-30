<?php

namespace OP\Services\Entities;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractEntities extends Model
{

    public function findById($id)
    {
        return $this->find($id);
    }

    public function findbySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function findWhere(array $array)
    {
        return $this->where($array)->first();
    }

}
