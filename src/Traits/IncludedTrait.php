<?php

namespace elementary\helpers\JsonApi\Traits;

trait IncludedTrait
{
    /**
     * @var array
     */
    protected $included = [];

    /**
     * @return array
     */
    public function getIncluded()
    {
        return $this->included;
    }

    /**
     * @param array $data Format: ['test' => ['type' => 'test', 'id' => 1]]
     *
     * @return $this
     */
    public function setIncluded(array $data)
    {
        foreach ($data as $key => $item) {
            $this->addInclude($key, $item);
        }

        return $this;
    }

    /**
     * @param string $key
     * @param array  $data Resource Objects
     *
     * @see http://jsonapi.org/format/#document-resource-objects
     *
     * @return $this
     */
    public function addInclude($key, array $data)
    {
        if (empty($this->included[$key])) {
            $this->included[$key] = $data;
        } else {
            $this->included[$key] = array_merge($this->included[$key], $data);
        }

        return $this;
    }
}