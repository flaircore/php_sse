<?php
require_once 'bootstrap.php';
$dbConn = new \Nick\PhpSse\DbConn();
$entityManager = $dbConn->entityManager;
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

// run ` vendor/bin/doctrine orm:schema-tool:create`