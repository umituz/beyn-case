<?php

namespace Tests\Suites;

use Eloquent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;

/**
 * Class RepositoryTestSuite
 * @package Tests\Suites
 */
abstract class RepositoryTestSuite extends TestCase
{
    use WithFaker;

    /**
     * @return void
     */
    protected function setPrerequisites(): void
    {
        parent::setPrerequisites();
        $this->setRepository();
    }

    abstract public function setRepository();

    /**
     * @param array|Collection $expectedRows
     * @param LengthAwarePaginator $paginatedRows
     * @param array $columns
     */
    public function assertPagination($expectedRows, LengthAwarePaginator $paginatedRows, $columns = ['id'])
    {
        $this->assertInstanceOf(LengthAwarePaginator::class, $paginatedRows);
        $this->assertEquals(count($expectedRows), $paginatedRows->count(), 'Pagination Count Failed');

        foreach ($paginatedRows->items() as $key => $item) {
            $this->assertSameModel($expectedRows[$key], $item, $columns);
        }
    }

    /**
     * @param Eloquent $model
     */
    public function assertModelDeleted(Eloquent $model)
    {
        $this->assertNull($model->fresh());
    }

    /**
     * @param Eloquent $model
     */
    public function assertModelSoftDeleted(Eloquent $model)
    {
        $this->assertFalse($model->fresh()->exists());
    }

    /**
     * @param Eloquent $model
     * @param string $property
     * @param mixed $expectedValue
     */
    public function assertModelPropertyUpdated(Eloquent $model, $property, $expectedValue)
    {
        $this->assertEquals($model->fresh()->$property, $expectedValue);
    }

    /**
     * @param Eloquent $model
     * @param array $properties
     */
    public function assertModelPropertiesUpdated(Eloquent $model, array $properties)
    {
        $model->refresh();

        foreach ($properties as $property => $expectedValue) {
            $this->assertEquals($model->$property, $expectedValue);
        }
    }

    /**
     * @param Eloquent $model
     * @param array $properties
     */
    public function assertModelPropertiesNotUpdated(Eloquent $model, array $properties)
    {
        $model->refresh();

        foreach ($properties as $property => $expectedValue) {
            $this->assertNotEquals($model->$property, $expectedValue);
        }
    }
}
