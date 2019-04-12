<?php
declare(strict_types=1);

namespace SONFin\Plugins;

use Psr\Container\ContainerInterface;
use SONFin\Repository\RepositoryFactory;
use SONFin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class DbPlugin implements PluginInterface
{
    /**
     * @param ServiceContainerInterface $container
     */
    public function register(ServiceContainerInterface $container)
    {

        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';
        $capsule->addConnection($config['default_connection']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());
        $container->addLazy('category-costs.repository', function (ContainerInterface $container){
            return $container->get('repository.factory')->factory(\SONFin\Models\CategoryCost::class);
        });

        $container->addLazy('users.repository', function (ContainerInterface $container){
            return $container->get('repository.factory')->factory(\SONFin\Models\User::class);
        });

        $container->addLazy('empresas.repository', function (ContainerInterface $container){
            return $container->get('repository.factory')->factory(\SONFin\Models\Empresa::class);
        });

    }
}