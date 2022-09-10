<?php

namespace Tests\Unit\Scopes;

use App\Scopes\ReverseScope;
use Illuminate\Database\Eloquent\Builder;
use Tests\Fakes\App\Models\ModelHavingScopesFake;
use Tests\Suites\ScopeTestSuite;

/**
 * Class ReverseScopeTest
 * @package Tests\Unit\Scopes
 * @coversDefaultClass \App\Scopes\ReverseScope
 */
class ReverseScopeTest extends ScopeTestSuite
{
    /** @var ReverseScope */
    protected $scope;

    public function setScope()
    {
        $this->scope = new ReverseScope();
    }

    /**
     * @test
     * @covers ::apply
     */
    function it_should_apply_order_by_desc_scope()
    {
        $this->builder->expects($this->once())->method('orderByDesc')->with('id')->willReturnSelf();

        $this->assertInstanceOf(Builder::class, $this->scope->apply($this->builder, new ModelHavingScopesFake()));
    }
}
