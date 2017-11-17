<?php

namespace elementary\helpers\JsonApi\Interfaces;

interface MetaInterface
{
    /**
     * @return array
     */
    public function getMeta();

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setMeta(array $data);

    /**
     * @param string $key
     * @param mixed  $data
     *
     * @return $this
     */
    public function addMeta($key, $data);
}