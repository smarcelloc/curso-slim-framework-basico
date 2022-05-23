<?php

namespace App\Supports;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

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
        $path = array(PATH['entities']);
        $config = ORMSetup::createAnnotationMetadataConfiguration($path, isLocal());

        return EntityManager::create(DB, $config);
    }
}
