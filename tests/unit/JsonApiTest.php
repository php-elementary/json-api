<?php

namespace elementary\helpers\JsonApi\Test;

use elementary\helpers\JsonApi\JsonApi;
use elementary\helpers\JsonApi\JsonData;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \elementary\helpers\JsonApi\JsonApi
 */
class JsonApiTest extends TestCase
{
    /**
     * @test
     * @covers ::getData()
     * @covers ::setData()
     * @covers ::addData()
     */
    public function checkData()
    {
        /** @var JsonData $mock */
        $data = new JsonData();
        $api  = new JsonApi();

        $obj = $api->addData('test', $data);
        $this->assertEquals(['test' => $data], $obj->getData());

        $obj = $api->setData(['test2' => $data]);
        $this->assertEquals(['test' => $data,'test2' => $data], $obj->getData());
    }

    /**
     * @test
     * @covers ::compile()
     */
    public function compile()
    {
        $data = new JsonData();

        $this->assertEquals(
            [
                'data' => [
                    ['type' => 'test1', 'id' => ''],
                    ['type' => 'test2', 'id' => ''],
                ],
                'links'    => ['test3' => 'test3'],
                'included' => [['type' => 'test4']],
                'meta'     => ['test5' => 'test5'],

            ], (new JsonApi())->setData([new JsonData('test1'), new JsonData('test2')])
                              ->setLinks(['test3' => 'test3'])
                              ->setIncluded(['test4' => ['type' => 'test4']])
                              ->setMeta(['test5' => 'test5'])
                              ->compile()
        );
    }
}
