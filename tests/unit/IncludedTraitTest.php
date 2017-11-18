<?php

namespace elementary\helpers\JsonApi\Test;

use elementary\helpers\JsonApi\Traits\IncludedTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \elementary\helpers\JsonApi\Traits\IncludedTrait
 */
class IncludedTraitTest extends TestCase
{
    /**
     * @test
     * @covers ::getIncluded()
     * @covers ::setIncluded()
     * @covers ::addInclude()
     */
    public function checkLinks()
    {
        /** @var IncludedTrait $mock */
        $mock = $this->getMockForTrait('elementary\helpers\JsonApi\Traits\IncludedTrait');

        $mock->setIncluded(['test' => ['test' => 'test']]);
        $this->assertEquals(['test' => ['test' => 'test']], $mock->getIncluded());

        $mock->setIncluded(['test' => ['test2' => 'test2'], 'test3' => ['test3' => 'test3']]);
        $this->assertEquals(['test' => ['test' => 'test', 'test2' => 'test2'], 'test3' => ['test3' => 'test3']], $mock->getIncluded());

        $mock->addInclude('test', ['test4' => 'test4'])
             ->addInclude('test5', ['test5' => 'test5']);
        $this->assertEquals(['test' => ['test' => 'test', 'test2' => 'test2', 'test4' => 'test4'], 'test3' => ['test3' => 'test3'], 'test5' => ['test5' => 'test5']], $mock->getIncluded());
    }
}
