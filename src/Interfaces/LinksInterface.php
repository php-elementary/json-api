<?php

namespace elementary\helpers\JsonApi\Interfaces;

interface LinksInterface
{
    /**
     * @return array
     */
    public function getLinks();

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setLinks(array $data);

    /**
     * @param string $key
     * @param mixed  $data
     *
     * @return $this
     */
    public function addLink($key, $data);
}