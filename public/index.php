<?php

require '../app/core/Router.php';
require '../app/controllers/login.php'; 
require '../app/controllers/home.php'; 

$router = new Router();
$router->run();