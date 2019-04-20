<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace src\Controllers;

use src\Model\Login;
use Httpful;
use src\Adapter\HttpAdapter;
use src\Controllers\APIController;
use src\Config;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

/**
 * Description of ImagesController
 *
 * @author Daniel
 */
class PageController extends Config {

    public function __construct() {
        parent::__construct();
    }

    public function View($param = array()) {

         var_export($param);
        exit();
        return require_once __DIR__ . '/../Views/Page.php';
    }
    
    public function Fotokopiasprawozdanfinansowychzakt($param = array()) {

        return require_once __DIR__ . '/../Views/FSFzAkt.php';
    }

    public function ErrorAccess($param = array()) {

        return require_once __DIR__ . '/../Views/ErrorAccess.php';
    }

    public function Error404($param = array()) {

        return require_once __DIR__ . '/../Views/Error404.php';
    }

}
