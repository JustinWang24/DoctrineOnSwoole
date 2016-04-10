<?php
namespace justinwang24\DoctrineOnSwoole;

use \Doctrine\ORM\Tools\Setup as SetupTool;
use \Doctrine\ORM\EntityManager as EntityManager;

class Manager{
    private $config = null;
    private $entityManager = null;
    private $connection = null;
    private $isDevMode = true;

    public function __construct($connection=null,$configPath=null,$isDevMode=false){
        if($this->isDevMode != $isDevMode)
            $this->isDevMode = $isDevMode;

        if($connection){
            $this->connection = $connection;
        }else{
            $this->connection = [
                'driver'=>'pdo_sqlite',
                'path'  =>__DIR__.'/db.sqlite'
            ];
        }

        if(!$configPath){
            $configPath = [__DIR__.'/models_description'];
        }
        $this->config = SetupTool::createAnnotationMetadataConfiguration(
            $configPath,
            $this->isDevMode
        );

        $this->init();
    }

    public function init(){
        $this->entityManager = EntityManager::create(
            $this->connection,
            $this->config
        );
    }

    public function getInstance(){
        return $this->entityManager;
    }

    public function setConfig($config){
        $this->config = $config;
    }

    public function setConnection($connection){
        $this->connection = $connection;
    }
}

