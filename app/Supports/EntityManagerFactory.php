<?php

namespace App\Supports;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;

/**
 * Setup das entidades manager ORM.
 */
class EntityManagerFactory
{
    /**
     * Retorna a entidade manager.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        // Metadado de Anotação
        $path = array(PATH['app'] . '/Entities');
        $config = ORMSetup::createAnnotationMetadataConfiguration($path, !isProduction());

        // Cache
        if (isProduction()) {
            $cache = new PhpFilesAdapter('db', 0, PATH['cache']);
            $config->setMetadataCache($cache);
        }

        return EntityManager::create(DATABASE, $config);
    }
}
