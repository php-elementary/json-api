<?php

namespace elementary\helpers\JsonApi\Traits;

trait MetaTrait
{
    /**
     * @var array
     */
    protected $meta = [];

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setMeta(array $data)
    {
        $this->meta = array_merge_recursive($this->meta, $data);

        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $data
     *
     * @return $this
     */
    public function addMeta($key, $data)
    {
        if (!empty($this->meta[$key]) && is_array($this->meta[$key]) && is_array($data)) {
            $this->meta[$key] = array_merge_recursive($this->meta[$key], $data);
        } else {
            $this->meta[$key] = $data;
        }

        return $this;
    }
}