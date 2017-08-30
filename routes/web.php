<?php

$router = new \Kernel\Router();

$router->get("/","IndexController@index");

$router->get("place", "PlaceController@all");
$router->post("place", "PlaceController@store");
$router->get('place/test', "PlaceController@test");
$router->get("place/{id}", "PlaceController@find");
$router->get("place/delete/{id}", "PlaceController@delete");
$router->post("place/{id}", "PlaceController@update");

$router->get("login","AuthController@login");
$router->post("login","AuthController@postLogin");
$router->get("logout", "AuthController@logout");


$router->post('api/place', "PlaceController@place");
return $router;