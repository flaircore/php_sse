<?php

namespace Nick\PhpSse;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class DbConn
{

    public $connection;
    public $entityManager;

    function __construct()
    {
        /**
         * database configuration parameters
         */
        $CONNECTION_PARAMS = [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . 'data.sqlite'
        ];
        $conn = \Doctrine\DBAL\DriverManager::getConnection($CONNECTION_PARAMS);
        $this->connection = $conn;
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
        // obtaining the entity manager

        $this->entityManager = EntityManager::create($conn, $config);

    }

}