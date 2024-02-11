<?php

namespace ContainerEg5QxTx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Pe_SjzDService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Pe.SjzD' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Pe.SjzD'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'authorRepository' => ['privates', 'App\\Repository\\AuthorRepository', 'getAuthorRepositoryService', true],
        ], [
            'authorRepository' => 'App\\Repository\\AuthorRepository',
        ]);
    }
}
