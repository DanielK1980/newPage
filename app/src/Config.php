<?php

namespace src;

class Config {

    static public $protocol;
    static public $protocolAndHost;
    static public $protocolAPI;
    static public $hostAPI;
    static public $assetsPath;
    static public $protocolAndHostAPI;
    static public $protocolHostAndLokAPI;
    static public $tmplPath;
    static public $DBHost;
    static public $DBName;
    static public $DBLogin;
    static public $DBPass;

    public function __construct() {       
        $this::$protocol = $_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == 'etest.cbb.pl' ? 'http://' : 'https://';
        $this::$protocolAndHost = $_SERVER['SERVER_NAME'] == 'localhost' ? $this::$protocol . $_SERVER['SERVER_NAME']."/rejestrinfonew" : $this::$protocol . $_SERVER['SERVER_NAME'] ;
        $this::$protocolAPI = 'https://';
        $this::$hostAPI = $_SERVER['SERVER_NAME'] == 'localhost' ? '192.168.5.13' : 'mg.cbb.pl';
        $this::$protocolAndHostAPI = $this::$protocolAPI . $this::$hostAPI;
        $this::$protocolHostAndLokAPI =  $_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == 'etest.cbb.pl' ? $this::$protocolAndHostAPI."/wfmWebApi_test" : $this::$protocolAndHostAPI."/wfmWebApi";
        $this::$assetsPath = $this::$protocolAndHost . "/Public";
        $this::$tmplPath = $_SERVER['SERVER_NAME'] == 'localhost' ? "../Public/tmpls/" : "/Public/tmpls/";  
        
        
        //DB
        $this::$DBHost = "23218.m.tld.pl";
        $this::$DBName = "baza23218_api_prod";
        $this::$DBLogin = "admin23218_api_prod";
        $this::$DBPass = "Cbbpl2018";
    }
}
