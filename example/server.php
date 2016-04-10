<?php
require_once '../../vendor/autoload.php';

use justinwang24\DoctrineOnSwoole\Manager as Manager;

class Server{
    private $serv;
    private $manager = null;

    public function __construct(){
        $this->serv = new swoole_server("0.0.0.0", 9501);
        $this->serv->set(array(
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 2,
            'debug_mode'=> 1
        ));

        $this->serv->on('Start', array($this, 'onStart'));
        $this->serv->on('Connect', array($this, 'onConnect'));
        $this->serv->on('Receive', array($this, 'onReceive'));
        $this->serv->on('Close', array($this, 'onClose'));

        $manager = new Manager();
        if($manager)
            $this->manager = $manager->getInstance();

        $this->serv->start();
    }

    public function onStart($serv){
        echo "Swoole Server Start\n";
    }

    public function onConnect( $serv, $fd, $from_id ) {
        $serv->send( $fd, "Hello {$fd}!" );
    }

    public function onReceive( swoole_server $serv, $fd, $from_id, $data ) {
        echo "Get Message From Client {$fd}:{$data}\n";
        if($data=='add'){
            //表示要输入一个新产品
            $newProductName = "product_name".time();
            $product = new Product();
            $product->setName($newProductName);
            $this->manager->persist($product);
            $this->manager->flush();
            echo "Created Product with ID: ".$product->getId()."\n";
        }elseif($data=='find'){
            echo "I know you want to find something\n";
        }else{
            echo 'No idea\n';
        }
    }

    public function onClose( $serv, $fd, $from_id ) {
        echo "Client {$fd} close connection\n";
    }
}

// 启动服务器
$server = new Server();
?>
