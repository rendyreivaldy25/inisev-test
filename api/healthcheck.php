<?php

    require_once '../helper/connection.php';
    require_once '../configs.php';

    $connection = new Connection(
        $CONFIGS['DB_HOST'], 
        $CONFIGS['DB_USERNAME'],
        $CONFIGS['DB_PASSWORD'],
        $CONFIGS['DB_NAME']
    );
    $connectionCheck = $connection->connectionCheck();
    if(!$connectionCheck['status']){
        echo "Connection to MySQL failed. Error : ".$connectionCheck['message'];
        exit;
    }
    echo "Connection healthy";
