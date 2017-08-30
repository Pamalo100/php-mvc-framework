<?php

include_once('bootstrap/app.php');
include_once('bootstrap/autoload.php');
include_once('bootstrap/helper.php');


header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Authorization, Content-Type, X-Requested-With");


$app = new \Kernel\App();
$app->init();