<?php

namespace Tests\Suites;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class ModelTestSuite
 * @package Tests\Suites
 */
class ModelTestSuite extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * @return void
     */
    protected function setPrerequisites(): void
    {
        parent::setPrerequisites();
        $this->setModel();
    }

    public function setModel()
    {
    }
}
