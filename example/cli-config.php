<?php
/**
 * Created by PhpStorm.
 * User: justinwang
 * Date: 11/04/16
 * Time: 1:58 AM
 */
require_once "bootstrap.php";
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
));
return $helperSet;