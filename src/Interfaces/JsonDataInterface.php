<?php

namespace elementary\helpers\JsonApi\Interfaces;

interface JsonDataInterface extends CompileInterface, IncludedInterface, LinksInterface, MetaInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * @return array
     */
    public function getAttributes();

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setAttributes(array $data);

    /**
     * @param string $key
     * @param mixed  $data
     *
     * @return $this
     */
    public function addAttribute($key, $data);

    /**
     * @return array
     */
    public function getRelationships();

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setRelationships(array $data);

    /**
     * @param string $key
     * @param array  $data
     *
     * @return $this
     */
    public function addRelationship($key, array $data);
}