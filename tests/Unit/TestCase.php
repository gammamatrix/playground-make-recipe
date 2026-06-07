<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Make\Recipe;

use Playground\ServiceProvider;
use Playground\Test\OrchestraTestCase;

/**
 * \Tests\Unit\Playground\Make\Recipe\TestCase
 */
class TestCase extends OrchestraTestCase
{
    use FileTrait;

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
            \Playground\Make\ServiceProvider::class,
            \Playground\Make\Recipe\ServiceProvider::class,
        ];
    }
}
