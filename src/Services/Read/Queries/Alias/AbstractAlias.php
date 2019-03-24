<?php

namespace OP\Services\Read\Queries\Alias;

abstract class AbstractAlias
{

    protected $alias;

    public function generate($fields)
    {
        $fieldsKey = array_keys($this->alias);
        $finalResult = [];
        foreach ($fields as $field) {
            if (in_array($field, $fieldsKey)) {
                $finalResult[] = $this->alias[$field] . ' as ' . $field;
            }
        }

        return implode(",", $finalResult);
    }

    protected function getByKey($key)
    {
        return !empty($this->alias[$key]) ? $this->alias[$key] : false;
    }

    protected function generateCustomAliasBykey($key, $aliasName)
    {
        return !empty($this->alias[$key]) ? $this->alias[$key] . ' as ' . $aliasName : false;
    }
}
