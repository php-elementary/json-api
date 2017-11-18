<?php

namespace elementary\helpers\JsonApi\Test;

use elementary\helpers\JsonApi\JsonData;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \elementary\helpers\JsonApi\JsonData
 */
class JsonDataTest extends TestCase
{
    /**
     * @test
     * @covers ::getType()
     * @covers ::setType()
     * @covers ::__construct()
     */
    public function checkType()
    {
        $obj = new JsonData('test');
        $this->assertEquals('test', $obj->getType());

        $obj = (new JsonData())->setType('test2');
        $this->assertEquals('test2', $obj->getType());
    }

    /**
     * @test
     * @covers ::getId()
     * @covers ::setId()
     * @covers ::__construct()
     */
    public function checkId()
    {
        $obj = new JsonData('', 'test');
        $this->assertEquals('test', $obj->getId());

        $obj = (new JsonData())->setId('test2');
        $this->assertEquals('test2', $obj->getId());
    }

    /**
     * @test
     * @covers ::getAttributes()
     * @covers ::setAttributes()
     * @covers ::addAttribute()
     */
    public function checkAttributes()
    {
        $obj = (new JsonData())->addAttribute('test', ['test']);
        $this->assertEquals(['test' => ['test']], $obj->getAttributes());

        $obj->setAttributes(['test2' => 2]);
        $this->assertEquals(['test' => ['test'], 'test2' => 2], $obj->getAttributes());
    }

    /**
     * @test
     * @covers ::getRelationships()
     * @covers ::setRelationships()
     * @covers ::addRelationship()
     * @covers ::compile()
     */
    public function checkRelationships()
    {
        $mock = $this->getMockBuilder('elementary\helpers\JsonApi\JsonData')->setMethods(['getId'])->getMock();
        $mock->method('getId')->willReturn('test');

        /** @var JsonData $mock */

        $obj = (new JsonData())->addRelationship('test', [$mock]);
        $this->assertEquals(['test' => ['data' => [['type' => '', 'id' => 'test']]]], $obj->getRelationships());

        $mock2 = $this->getMockBuilder('elementary\helpers\JsonApi\JsonData')->setMethods(['getId'])->getMock();
        $mock2->method('getId')->willReturn('test3');

        /** @var JsonData $mock2 */
        $mock2->setIncluded(['test2' => ['type' => 'test2']]);

        $obj->setRelationships(['test4' => [$mock2]]);
        $this->assertEquals(
            [
                'test'  => ['data' => [['type' => '', 'id' => 'test']]],
                'test4' => ['data' => [['type' => '', 'id' => 'test3']]]
            ], $obj->getRelationships()
        );

        $this->assertEquals(
            [
                'test'  => ['type' => '', 'id' => 'test'],
                'test2' => ['type' => 'test2'],
                'test3' => ['type' => '', 'id' => 'test3'],
            ], $obj->getIncluded()
        );
    }

    /**
     * @test
     * @covers ::compile()
     */
    public function compile()
    {
        $mock = $this->getMockBuilder('elementary\helpers\JsonApi\JsonData')->setMethods(['getId'])->getMock();
        $mock->method('getId')->willReturn('mock');

        $obj = new JsonData('test1', 'test2');
        $obj->setAttributes(['test3' => 'test3'])
            ->setRelationships(['test4' => [$mock]])
            ->setLinks(['test5' => 'test5'])
            ->setMeta(['test6' => 'test6']);

        $this->assertEquals(
            [
                'type' => 'test1',
                'id'   => 'test2',
                'attributes'    => ['test3' => 'test3'],
                'relationships' => ['test4' => ['data' => [['type' => '', 'id' => 'mock']]]],
                'links' => ['test5' => 'test5'],
                'meta'  => ['test6' => 'test6'],
            ], $obj->compile()
        );
    }

    /**
     * @test
     * @covers ::addRelationship()
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Array must contains an object only type of JsonDataInterface
     */
    public function addRelationshipFault()
    {
        (new JsonData())->addRelationship('test', ['test']);
    }
}
