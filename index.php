<?php

//include php framework slim
$loader = require __DIR__ . '/vendor/autoload.php';
//include monolog psr3
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
// Create the logger
$logger = new Logger('FizzBuzz');

//load object slim
$app = new 	\Slim\Slim();

// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/log/info.log', Logger::INFO));
$logger->pushHandler(new FirePHPHandler());
//autoload system psr4
spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/'.$class_name . '.php';
});
//load in slim monolog
$app->container->logger = $logger;

//register log
$logger->info("init aplication");

$app->get('/fizzbuzz/:number_min/:number_max', function($number_min, $number_max) use ($app){
    //load class fizzbuzz
    $fb = new \bin\FizzBuzz();
    //set values in variables
    $fb->setNumber_Max($number_max);
    $fb->setNumber_Min($number_min);
   
    //validate data
    $resp = $fb->validateInfo();
    //validate response 
    if($resp == "sucess")
    {
        //message of welcome
        echo "Welcome<br>";
        //message of process
        echo "Number initial $number_min Number End $number_max <br>";
        echo "<br>Result Data: <br>";
        //process values 
        $values = $fb->calcValues();
        //print result of data
        foreach ($values as $row){
            echo "$row<br>";
        }
        //message of finish process
        echo "Process Finished";
        //save data of processs valid
        $app->container->logger->info("The data is valid, starting process",array("number 1"=> $number_min,"number 2"=> $number_max));
    }
    else
    {
        //show error message
        echo "problem:<br>".$resp;
        //save log error
        $app->container->logger->error($resp, array("number 1"=> $number_min,"number 2"=> $number_max));
        
    }
});

$app->run();