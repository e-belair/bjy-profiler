<?php

declare(strict_types=1);

namespace BjyProfiler;

use BjyProfiler\Db\Adapter\ProfilingAdapterFactory;
use Laminas\Db\Adapter\AdapterInterface;

final class ConfigProvider
{
    /**
     * Retrieve BjyProfiler default configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
        ];
    }

    /**
     * Retrieve BjyProfiler default dependency configuration.
     */
    public function getDependencyConfig(): array
    {
        return [
            'factories' => [
                AdapterInterface::class => ProfilingAdapterFactory::class,
            ],
        ];
    }
}
