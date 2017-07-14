<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once "bootstrap.php";

// defaults configs for Doctrine ORM
$ormConfig = Setup::createAnnotationMetadataConfiguration(
    [ __DIR__ . '/models/' ],
    false,
    null,
    null,
    false
);

// db connection configuration
$connectionOptions = $configs['db'];

$entityManager = EntityManager::create($connectionOptions, $ormConfig);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);