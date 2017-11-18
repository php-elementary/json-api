<?php

namespace elementary\helpers\JsonApi\Test;

use elementary\helpers\JsonApi\Traits\MetaTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \elementary\helpers\JsonApi\Traits\MetaTrait
 */
class MetaTraitTest extends TestCase
{
    /**
     * @test
     * @covers ::getMeta()
     * @covers ::setMeta()
     * @covers ::addMeta()
     */
    public function checkMeta()
    {
        /** @var MetaTrait $mock */
        $mock = $this->getMockForTrait('elementary\helpers\JsonApi\Traits\MetaTrait');

        $mock->setMeta(['test' => ['test' => 'test']]);
        $this->assertEquals(['test' => ['test' => 'test']], $mock->getMeta());

        $mock->setMeta(['test' => ['test2' => 'test2'], 'test3' => 'test3']);
        $this->assertEquals(['test' => ['test' => 'test', 'test2' => 'test2'], 'test3' => 'test3'], $mock->getMeta());

        $mock->addMeta('test4', 'test4')
             ->addMeta('test3', ['test3' => 'test3'])
             ->addMeta('test', ['test5' => 'test5']);
        $this->assertEquals(['test' => ['test' => 'test', 'test2' => 'test2', 'test5' => 'test5'], 'test3' => ['test3' => 'test3'], 'test4' => 'test4'], $mock->getMeta());
    }
}
