<?php

namespace OP\Services\Transformers;

use League\Fractal\TransformerAbstract;

class CollectionTransformer extends TransformerAbstract
{
    public function transform($collection)
    {
        return  (array) $collection;
    }
}
