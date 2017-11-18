<?php

namespace elementary\helpers\JsonApi\Interfaces;

interface IncludedInterface
{
    /**
     * @return array
     */
    public function getIncluded();

    /**
     * @param array $data Format: ['test' => ['type' => 'test', 'id' => 1]]
     *
     * @return $this
     */
    public function setIncluded(array $data);

    /**
     * @param string $key
     * @param array  $data Resource Objects
     *
     * @see http://jsonapi.org/format/#document-resource-objects
     *
     * @return $this
     */
    public function addInclude($key, array $data);
}