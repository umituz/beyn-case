<?php

namespace Tests\Unit\Providers;

use App\Providers\RepositoryServiceProvider;
use App\Repositories\BrandRepository;
use App\Repositories\BrandRepositoryInterface;
use App\Repositories\CarRepository;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Repositories\ServiceRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Tests\TestCase;

/**
 * Class RepositoryServiceProviderTest
 * @package Tests\Unit\Providers
 * @coversDefaultClass \App\Providers\RepositoryServiceProvider
 */
class RepositoryServiceProviderTest extends TestCase
{
    /**
     * @return array
     */
    public function segmentsProvider(): array
    {
        return [
            [BrandRepositoryInterface::class, BrandRepository::class],
            [CarRepositoryInterface::class, CarRepository::class],
            [ServiceRepositoryInterface::class, ServiceRepository::class],
            [OrderRepositoryInterface::class, OrderRepository::class],
            [UserRepositoryInterface::class, UserRepository::class],
        ];
    }

    /**
     * @test
     * @dataProvider segmentsProvider
     * @param string $abstract
     * @param string $concrete
     * @covers ::boot
     */
    function it_should_register_repositories(string $abstract, string $concrete)
    {
        (new RepositoryServiceProvider($this->app))->register();

        $this->assertInstanceOf($concrete, $this->app->make($abstract));
    }
}
