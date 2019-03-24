<?php

namespace OP\Room\Fields;

final class Fillables
{
    const FIELDS = [
        'name',
        'description',
        'dj_id'
    ];

    final public static function getAllowedFields()
    {
        return self::FIELDS;
    }
}
