<?php

namespace Tests\Suites;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

/**
 * Class ScopeTestSuite
 * @package Tests\Suites
 */
abstract class ScopeTestSuite extends TestCase
{
    /** @var Builder|MockObject $builder */
    protected $builder;

    /**
     * @inheritdoc
     */
    protected function setPrerequisites()
    {
        parent::setPrerequisites();

        $this->setScope();
        $this->mockBuilder();
    }

    abstract public function setScope();

    public function mockBuilder()
    {
        $this->builder = $this->createMock(Builder::class);
    }
}
