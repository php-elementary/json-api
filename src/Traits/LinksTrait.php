<?php

namespace elementary\helpers\JsonApi\Traits;

trait LinksTrait
{
    /**
     * @var array
     */
    protected $links = [];

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setLinks(array $data)
    {
        $this->links = array_merge_recursive($this->links, $data);

        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $data
     *
     * @return $this
     */
    public function addLink($key, $data)
    {
        if (!empty($this->links[$key]) && is_array($this->links[$key]) && is_array($data)) {
            $this->links[$key] = array_merge($this->links[$key], $data);
        } else {
            $this->links[$key] = $data;
        }

        return $this;
    }
}