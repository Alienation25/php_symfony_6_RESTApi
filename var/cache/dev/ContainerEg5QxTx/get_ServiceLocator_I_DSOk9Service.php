<?php

namespace ContainerEg5QxTx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_I_DSOk9Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.I.dSOk9' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.I.dSOk9'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'App\\Controller\\AuthorController::createAuthor' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\AuthorController::indexAuthor' => ['privates', '.service_locator.c2_CVxI', 'get_ServiceLocator_C2CVxIService', true],
            'App\\Controller\\AuthorController::showAuthor' => ['privates', '.service_locator.Pe.SjzD', 'get_ServiceLocator_Pe_SjzDService', true],
            'App\\Controller\\BookController::createBook' => ['privates', '.service_locator.pLlJPBL', 'get_ServiceLocator_PLlJPBLService', true],
            'App\\Controller\\BookController::indexBook' => ['privates', '.service_locator.mMHroBc', 'get_ServiceLocator_MMHroBcService', true],
            'App\\Controller\\BookController::showBook' => ['privates', '.service_locator.E86grY4', 'get_ServiceLocator_E86grY4Service', true],
            'App\\Controller\\BookController::updateBook' => ['privates', '.service_locator.SOZ0Wth', 'get_ServiceLocator_SOZ0WthService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Service\\AuthorService::create' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Service\\AuthorService::index' => ['privates', '.service_locator.c2_CVxI', 'get_ServiceLocator_C2CVxIService', true],
            'App\\Service\\AuthorService::show' => ['privates', '.service_locator.Pe.SjzD', 'get_ServiceLocator_Pe_SjzDService', true],
            'App\\Service\\BookService::create' => ['privates', '.service_locator.pLlJPBL', 'get_ServiceLocator_PLlJPBLService', true],
            'App\\Service\\BookService::index' => ['privates', '.service_locator.mMHroBc', 'get_ServiceLocator_MMHroBcService', true],
            'App\\Service\\BookService::show' => ['privates', '.service_locator.E86grY4', 'get_ServiceLocator_E86grY4Service', true],
            'App\\Service\\BookService::update' => ['privates', '.service_locator.SOZ0Wth', 'get_ServiceLocator_SOZ0WthService', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Controller\\AuthorController:createAuthor' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\AuthorController:indexAuthor' => ['privates', '.service_locator.c2_CVxI', 'get_ServiceLocator_C2CVxIService', true],
            'App\\Controller\\AuthorController:showAuthor' => ['privates', '.service_locator.Pe.SjzD', 'get_ServiceLocator_Pe_SjzDService', true],
            'App\\Controller\\BookController:createBook' => ['privates', '.service_locator.pLlJPBL', 'get_ServiceLocator_PLlJPBLService', true],
            'App\\Controller\\BookController:indexBook' => ['privates', '.service_locator.mMHroBc', 'get_ServiceLocator_MMHroBcService', true],
            'App\\Controller\\BookController:showBook' => ['privates', '.service_locator.E86grY4', 'get_ServiceLocator_E86grY4Service', true],
            'App\\Controller\\BookController:updateBook' => ['privates', '.service_locator.SOZ0Wth', 'get_ServiceLocator_SOZ0WthService', true],
            'App\\Service\\AuthorService:create' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Service\\AuthorService:index' => ['privates', '.service_locator.c2_CVxI', 'get_ServiceLocator_C2CVxIService', true],
            'App\\Service\\AuthorService:show' => ['privates', '.service_locator.Pe.SjzD', 'get_ServiceLocator_Pe_SjzDService', true],
            'App\\Service\\BookService:create' => ['privates', '.service_locator.pLlJPBL', 'get_ServiceLocator_PLlJPBLService', true],
            'App\\Service\\BookService:index' => ['privates', '.service_locator.mMHroBc', 'get_ServiceLocator_MMHroBcService', true],
            'App\\Service\\BookService:show' => ['privates', '.service_locator.E86grY4', 'get_ServiceLocator_E86grY4Service', true],
            'App\\Service\\BookService:update' => ['privates', '.service_locator.SOZ0Wth', 'get_ServiceLocator_SOZ0WthService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Controller\\AuthorController::createAuthor' => '?',
            'App\\Controller\\AuthorController::indexAuthor' => '?',
            'App\\Controller\\AuthorController::showAuthor' => '?',
            'App\\Controller\\BookController::createBook' => '?',
            'App\\Controller\\BookController::indexBook' => '?',
            'App\\Controller\\BookController::showBook' => '?',
            'App\\Controller\\BookController::updateBook' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'App\\Service\\AuthorService::create' => '?',
            'App\\Service\\AuthorService::index' => '?',
            'App\\Service\\AuthorService::show' => '?',
            'App\\Service\\BookService::create' => '?',
            'App\\Service\\BookService::index' => '?',
            'App\\Service\\BookService::show' => '?',
            'App\\Service\\BookService::update' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\AuthorController:createAuthor' => '?',
            'App\\Controller\\AuthorController:indexAuthor' => '?',
            'App\\Controller\\AuthorController:showAuthor' => '?',
            'App\\Controller\\BookController:createBook' => '?',
            'App\\Controller\\BookController:indexBook' => '?',
            'App\\Controller\\BookController:showBook' => '?',
            'App\\Controller\\BookController:updateBook' => '?',
            'App\\Service\\AuthorService:create' => '?',
            'App\\Service\\AuthorService:index' => '?',
            'App\\Service\\AuthorService:show' => '?',
            'App\\Service\\BookService:create' => '?',
            'App\\Service\\BookService:index' => '?',
            'App\\Service\\BookService:show' => '?',
            'App\\Service\\BookService:update' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
