<?php
require_once "vendor/autoload.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: withCredentials');
header('Access-Control-Allow-Headers: Content-Type');

// Setup Doctrine
$configuration = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $paths = [__DIR__ . '/entities'],
    $isDevMode = true
);

// Setup connection parameters
$debug = true;
$connection_parameters = [
    'dbname' 	=> $debug ? 'devadmctism' 	: 'admctism',
    'user'		=> $debug ? 'root' 			: 'admctism',
    'password'	=> $debug ? '' 				: '',
    'host' 		=> $debug ? 'localhost' 	: 'bdctism',
    'driver' 	=> 'pdo_mysql',
    'charset' 	=> 'UTF8'
];

$GLOBALS['UPLOADSDIR'] = __DIR__ . '/uploads/';
$GLOBALS['JWT_KEY'] = '/etc/jwt2';

// Get the entity manager
$entity_manager = Doctrine\ORM\EntityManager::create($connection_parameters, $configuration);
