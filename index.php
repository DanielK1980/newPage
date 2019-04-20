<?php
//session_start();

use src\Controllers\RouteController;

require_once 'app/start.php';


$controller = new RouteController($_GET);

$controller->LoadView();

