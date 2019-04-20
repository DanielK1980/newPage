<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace src\Controllers;

use src\Config;

//use src\Controllers\ViewController;

class RouteController extends Config {

    protected $controller;
    protected $view;
    protected $url;
    protected $param = array();

    public function __construct(array $param) {
        parent::__construct();
        if (!empty($param)) {
            foreach ($param as $key => $arg) {
                if ($key == "action") {
                    if (method_exists($this, $arg)) {
                        $this->view = $arg;
                    } else {
                        //header("Location: " . $this::$protocolAndHost . "/calendar");
                        return header("Location: " . $this::$protocolAndHost . "/login/Error404");
                    }
                } else {
                    $this->param[$key] = $arg;
                }
            }
        }
    }

    public function LoadView() {
        $this->ViewParamUrl();
        $nam = "src\\Controllers\\" . $this->controller;
        $controller = new $nam();

        if (!method_exists($controller, $this->view)) {

            return header("Location: " . $this::$protocolAndHost . "/Page/Error404");
            //  header("Location: " . $this::$protocolAndHost . "/calendar");
        }
        return $controller->{"$this->view"}($this->param);
    }

    protected function isHtml($checkHTML) {
        $this->controller = "PageController";
        $this->view = "View";       
        $this->param["go"] = $checkHTML[0];
        
       
        /*
        $nameMethod = str_replace("-", "", ucwords($checkHTML[0]));
        
        if ($this->methodExist($this->controller, $nameMethod)) {
            $this->view = $nameMethod;
                      
        } else {
            return header("Location: " . $this::$protocolAndHost . "/Page/Error404");
        }
        */
    }

    protected function isNotHtml($urlfirst) {
        $url = explode("?", $urlfirst);
        $cutURL = array_values(array_filter(explode("/", $url[0])));
        $view = 0;
        if (!empty($cutURL) && isset($cutURL[0]) && !isset($cutURL[1])) {
            $this->view = "View";
        }
        if (!empty($cutURL) && isset($cutURL[0])) {
            foreach ($cutURL as $val) {

                if ($view == 0 && empty(strstr($val, '?'))) {

                    $path = __DIR__ . '/' . ucwords($val) . 'Controller.php';
                    $isFile = file_exists($path);

                    if (!empty($val) && $isFile) {
                        $this->controller = ucwords($val) . "Controller";
                    } else {
                        return header("Location: " . $this::$protocolAndHost . "/Page/Error404");
                    }
                }
                if ($view == 1 && empty(strstr($val, '?'))) {

                    if ($this->methodExist(ucwords($this->controller), $val)) {
                        $this->view = $val;
                    } else {
                        return header("Location: " . $this::$protocolAndHost . "/Page/Error404");
                    }
                }
                if ($view > 1 && empty(strstr($val, '?'))) {
                    $this->param[] = $val;
                }
                $view++;
            }
        } else {
            $path = __DIR__ . '/PageController.php';
            $isFile = file_exists($path);

            if ($isFile) {
                $this->view = "View";
                $this->controller = "PageController";
            } else {
                return header("Location: " . $this::$protocolAndHost . "/Page/Error404");
            }
        }

        if (empty($cutURL)) {
            $this->view = "View";
            $this->controller = "PageController";
        }
    }

    protected function methodExist($nameController, $nameMethod) {
        $nam = "src\\Controllers\\" . ucwords($nameController);
        $controller = new $nam();
        if (method_exists($controller, $nameMethod)) {
            return true;
        } else {
            return false;
        }
    }

    protected function ViewParamUrl() {
        $urlfirst = $_SERVER['SERVER_NAME'] == "localhost" ? str_replace("/rejestrinfonew/", "", $_SERVER['REQUEST_URI']) : $_SERVER['REQUEST_URI'];

        $checkHTML = explode(".", $urlfirst);

        if (isset($checkHTML[1]) && $checkHTML[1] == "html") {
            $this->isHtml($checkHTML);
        } else {
            $this->isNotHtml($urlfirst);
        }
    }

}
