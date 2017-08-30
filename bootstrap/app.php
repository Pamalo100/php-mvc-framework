<?php

$server = $_SERVER;
$scheme = $server['REQUEST_SCHEME'];
$method = strtoupper($server['REQUEST_METHOD']);
$script = $server['SCRIPT_NAME'];
$script = str_replace("/index.php", null, $script);
$script = trim($script);
$host = trim($server['HTTP_HOST']);

$baseURL = $scheme . "://" . $host . $script;

$pathInfo = isset($server['PATH_INFO']) ? $server['PATH_INFO'] : '/';
if($pathInfo !='/') $pathInfo = rtrim($pathInfo, "/");

$referer = isset($server['HTTP_REFERER']) ? $server['HTTP_REFERER'] : '/';
$referer = str_replace($baseURL ."/", null, $referer);
$referer = trim($referer);

define("BASE_URL", $baseURL);
define("ACTIVE_ROUTE", $pathInfo);
define("REFERER_URL", $referer);
define("REQUEST_METHOD", $method);
