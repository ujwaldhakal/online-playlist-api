<?php

namespace OP\Services\Read\Queries\Filters;


use Ep\Services\Exception\NoAnyProcessableFields;
use Illuminate\Support\Collection;
use OP\Services\Exceptions\NoFieldsAvailable;

abstract class AbstractFilter
{
    protected $allowedParams;
    protected $allowedFields;
    protected $fields;
    protected $params;

    public function __construct($filters)
    {

        $this->params = new Collection();
        foreach ($filters as $key => $filter) {
            if (\in_array($key, $this->allowedParams)) {

                if ($key === "fields") {
                    $filter = explode(',', $filter);
                }
                $this->params->put($key, $filter);
            }
        }

    }

    public function shouldFilterById()
    {
        return !empty($this->getId());
    }

    public function getId()
    {
        return $this->getParams('id');
    }

    public function getParams($key)
    {
        return $this->params->get($key);
    }


    protected function filterFields()
    {
        if (!$this->params->get('fields')) {
            throw new NoFieldsAvailable();
        }
        if ($this->params->get('fields')) {
            $this->fields = array_intersect($this->allowedFields, $this->params->get('fields'));
            if (empty($this->fields)) {
                throw new NoAnyProcessableFields();
            }
        }
    }


    public function shouldSearch()
    {
        return !empty($this->getParams('search'));
    }

    public function getSearchQuery()
    {
        return $this->getParams('search');
    }

    public function getFields(): array
    {
        $this->filterFields();

        return $this->fields ?? ['*'];
    }
}
