<?php

namespace elementary\helpers\JsonApi;

use elementary\helpers\JsonApi\Interfaces\JsonDataInterface;
use elementary\helpers\JsonApi\Traits\IncludedTrait;
use elementary\helpers\JsonApi\Traits\LinksTrait;
use elementary\helpers\JsonApi\Traits\MetaTrait;
use InvalidArgumentException;

class JsonData implements JsonDataInterface
{
    use LinksTrait,
        IncludedTrait,
        MetaTrait;

    /**
     * @var string
     */
    protected $type = '';

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $relationships = [];

    /**
     * @param string $type
     * @param string $id
     */
    public function __construct($type='', $id='')
    {
        $this->setType($type)
             ->setId($id);
    }

    /**
     * @return array
     */
    public function compile()
    {
        $returnValue = [
            'type'   => $this->getType(),
            'id'     => $this->getId(),
        ];

        if ($items = $this->getAttributes()) {
            $returnValue['attributes'] = $items;
        }

        if ($items = $this->getRelationships()) {
            $returnValue['relationships'] = $items;
        }

        if ($items = $this->getLinks()) {
            $returnValue['links'] = $items;
        }

        if ($items = $this->getMeta()) {
            $returnValue['meta'] = $items;
        }

        return $returnValue;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setAttributes(array $data)
    {
        foreach ($data as $key => $items) {
            $this->addAttribute($key, $items);
        }

        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $data
     *
     * @return $this
     */
    public function addAttribute($key, $data)
    {
        $this->attributes[$key] = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getRelationships()
    {
        return $this->relationships;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setRelationships(array $data)
    {
        foreach ($data as $key => $items) {
            $this->addRelationship($key, $items);
        }

        return $this;
    }

    /**
     * @param string $key
     * @param array  $data
     *
     * @return $this
     */
    public function addRelationship($key, array $data)
    {
        $relations = [];

        foreach ($data as $item) {

            if (!($item instanceof JsonDataInterface)) {
                throw new InvalidArgumentException('Array must contains an object only type of JsonDataInterface');
            }

            /** @var JsonDataInterface $item */
            $relations[] = [
                'type' => $item->getType(),
                'id'   => $item->getId(),
            ];

            $this->addInclude($item->getId(), $item->compile());
            $this->setIncluded($item->getIncluded());
        }

        $this->relationships[$key] = ['data' => $relations];

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}