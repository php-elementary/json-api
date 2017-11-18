<?php

namespace elementary\helpers\JsonApi\Test;

use elementary\helpers\JsonApi\Traits\LinksTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \elementary\helpers\JsonApi\Traits\LinksTrait
 */
class LinksTraitTest extends TestCase
{
    /**
     * @test
     * @covers ::getLinks()
     * @covers ::setLinks()
     * @covers ::addLink()
     */
    public function checkLinks()
    {
        /** @var LinksTrait $mock */
        $mock = $this->getMockForTrait('elementary\helpers\JsonApi\Traits\LinksTrait');

        $mock->setLinks(['test' => ['test' => 'test']]);
        $this->assertEquals(['test' => ['test' => 'test']], $mock->getLinks());

        $mock->setLinks(['test' => ['test2' => 'test2'], 'test3' => 'test3']);
        $this->assertEquals(['test' => ['test' => 'test', 'test2' => 'test2'], 'test3' => 'test3'], $mock->getLinks());

        $mock->addLink('test4', 'test4')
             ->addLink('test3', ['test3' => 'test3'])
             ->addLink('test', ['test5' => 'test5'])
             ->addLink('test', ['test2' => 'test6']);
        $this->assertEquals(['test' => ['test' => 'test', 'test2' => 'test6', 'test5' => 'test5'], 'test3' => ['test3' => 'test3'], 'test4' => 'test4'], $mock->getLinks());
    }
}
