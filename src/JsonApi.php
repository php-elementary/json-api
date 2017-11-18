<?php

namespace elementary\helpers\JsonApi;

use elementary\core\Singleton\SingletonTrait;
use elementary\helpers\JsonApi\Interfaces\JsonApiInteface;
use elementary\helpers\JsonApi\Interfaces\JsonDataInterface;
use elementary\helpers\JsonApi\Traits\IncludedTrait;
use elementary\helpers\JsonApi\Traits\LinksTrait;
use elementary\helpers\JsonApi\Traits\MetaTrait;

class JsonApi implements JsonApiInteface
{
    use SingletonTrait,
        LinksTrait,
        IncludedTrait,
        MetaTrait;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @return array
     */
    public function compile()
    {
        $returnValue = [
            'data' => []
        ];

        $objects = $this->getData();

        foreach ($objects as $key => $object) {
            /** @var JsonDataInterface $object */
            $returnValue['data'][] = $object->compile();
            $this->setIncluded($object->getIncluded());
        }

        if ($items = $this->getIncluded()) {
            $returnValue['included'] = array_values($items);
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
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        foreach ($data as $key => $items) {
            $this->addData($key, $items);
        }

        return $this;
    }

    /**
     * @param string            $key
     * @param JsonDataInterface $data
     *
     * @return $this
     */
    public function addData($key, JsonDataInterface $data)
    {
        $this->data[$key] = $data;

        return $this;
    }
}