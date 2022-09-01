<?php

namespace Webinertia\BjyProfiler\Db\Adapter;

use Webinertia\BjyProfiler\Db\Profiler;
use Interop\Container\ContainerInterface;
use Laminas\Log;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ProfilingAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Configuration');
        $adapter = new ProfilingAdapter($config['db']);

        if ('cli' === php_sapi_name()) {
            $logger = new Log\Logger();
            // write queries profiling info to stdout in CLI mode
            $writer = new Log\Writer\Stream('php://output');
            $logger->addWriter($writer, Log\Logger::DEBUG);
            $adapter->setProfiler(new Profiler\LoggingProfiler($logger));
        } else {
            $adapter->setProfiler(new Profiler\Profiler());
        }
        return $adapter;
    }
}
