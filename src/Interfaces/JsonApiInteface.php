<?php

namespace elementary\helpers\JsonApi\Interfaces;

interface JsonApiInteface extends CompileInterface, IncludedInterface, LinksInterface, MetaInterface
{
    /**
     * @return array
     */
    public function getData();

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data);

    /**
     * @param string            $key
     * @param JsonDataInterface $data
     *
     * @return $this
     */
    public function addData($key, JsonDataInterface $data);
}