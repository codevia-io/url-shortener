<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$configPath = './config.php';
$config = null;

if (file_exists($configPath)) {
    $config = include($configPath);
}

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

// Création d'une configuration pour Doctrine
// Voir : https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/tutorials/getting-started.html
$doctrinConfig = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . '/entities'], // Dossier contenant les entités
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

$conn = [
    'dbname' => $config->dbname,
    'user' => $config->user,
    'password' => $config->password,
    'host' => $config->host,
    'driver' => 'pdo_mysql',
];

// Obtention du gestionnaire d'entités
$entityManager = EntityManager::create($conn, $doctrinConfig);

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => null
]);
