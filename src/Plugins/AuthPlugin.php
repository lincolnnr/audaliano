<?php
declare(strict_types=1);

namespace SONFin\Plugins;

use Psr\Container\ContainerInterface;
use SONFin\Auth\Auth;
use SONFin\Auth\JasnyAuth;
use SONFin\ServiceContainerInterface;


class AuthPlugin implements PluginInterface
{
    /**
     * @param ServiceContainerInterface $container
     */
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('jasny.auth', function (ContainerInterface $container){
            return new JasnyAuth($container->get('user.repository'));
        });

        $container->addLazy('auth', function (ContainerInterface $container){
            return new Auth($container->get('jasny.auth'));
        });
    }
}