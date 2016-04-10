<?php
/**
 * Created by PhpStorm.
 * User: justinwang
 * Date: 11/04/16
 * Time: 1:56 AM
 */

use Doctrine\ORM\Tools\Setup;
require_once "../vendor/autoload.php";
// Create a simple "default" Doctrine ORM configuration for XML Mapping
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array("../src"), $isDevMode);
// or if you prefer yaml or annotations
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);
// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);
// obtaining the entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
