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
class LoginController extends Config {

    public function __construct() {
        parent::__construct();
    }

    public function View($param = array()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return require_once __DIR__ . '/../Views/Login.php';
    }

    /* Log Levels
      Monolog supports the logging levels described by RFC 5424.
      DEBUG (100): Detailed debug information.
      INFO (200): Interesting events. Examples: User logs in, SQL logs.
      NOTICE (250): Normal but significant events.
      WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
      ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
      CRITICAL (500): Critical conditions. Example: Application component unavailable, unexpected exception.
      ALERT (550): Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
      EMERGENCY (600): Emergency: system is unusable. */

    protected function Log($action, $level, $hr_id) {
        // Create the logger
        $logger = new Logger($action);
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../calendar.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        // You can now use your logger
        $logger->{$level}('Próba logowania', array('hr_id' => $hr_id));
    }

    public function Login() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        /*
          if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {

          return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/API/VIEW");
          }
         */
        if (isset($_POST['submit'])) {
            if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password'])) {

                $pattern = preg_quote('#$%^&*()+=-[]\';,./{}|\":<>?~', '#');
                $hr_id = $_POST['login'];
                $pass = $_POST['password'];

                if (preg_match("#[$pattern]#", $hr_id) || preg_match("#[$pattern]#", $pass)) {
                    $_SESSION['error'] = "Nieprawidłowy login lub hasło";
                    return header("Location: " . $this::$protocolAndHost . "/Login/VIEW");
                }
                if (!preg_match('/^(p{1}|P{1}|bc{1}|BC{1})?+[0-9]{6}$/', $hr_id) && (!preg_match('/^[0-9]{6}$/', $hr_id) )) {
                    $_SESSION['error'] = "Nieprawidłowy login lub hasło";
                    return header("Location: " . $this::$protocolAndHost . "/Login");
                }

                $hr_id = str_replace("bc", "P", $hr_id);
                $hr_id = str_replace("BC", "P", $hr_id);
                $hr_id = str_replace("p", "P", $hr_id);

                if (is_numeric($hr_id)) {
                    $hr_id = "P" . $hr_id;
                }

                $this->Log("Logowanie", "DEBUG", $hr_id);

                $password = md5($_POST['password']);
                $enc_key = '_CBBIsTheBestZRARules$eRVVi$2018R';
                $today = date("YmdHis");
                $crypt = base64_encode($password . $enc_key . $today);

                $url = "" . $this::$protocolAndHostAPI . "/wfmWebApi/api/auth";
                //  $url = "https://cbbwebapi/wfmWebApi/api/auth";
                $content = "{'HrId': '$hr_id','Password':'$crypt'}";

                try {
                    $response = new HttpAdapter();
                    $wynik = $response->post($url, $content);

                    if (!empty($wynik)) {

                        if ($wynik['code'] == 200 || $wynik['code'] == 201 || $wynik['code'] == 202) {
                            $this->Log("Udane logowanie ", "INFO", $hr_id);
                            $_SESSION['token'] = $wynik['body']->token;
                            $_SESSION['hrId'] = $wynik['body']->hrId;
                            $_SESSION['firstName'] = $wynik['body']->firstName;
                            $_SESSION['LAST_ACTIVITY'] = time();

                            $DbBadLogin = new Login();
                            $DbBadLogin->RemoveBadLogin($hr_id);

                            return header("Location: " . $this::$protocolAndHost . "/API/HOME");
                            // $API = new APIController();
                            // return $API->View(); //$API->getGrafikOnLoad($wynik['body']->firstName, $wynik['body']->hrId, $wynik['body']->token);
                        } else {
                            $code = $wynik['code'];
                            if ($code == 400) {
                                $DbBadLogin = new Login();
                                $DbBadLogin->AddBadLogin($hr_id);
                                $countBad = $DbBadLogin->GetBadLogin($hr_id);

                                if ($countBad > 2) {
                                    $url = "" . $this::$protocolAndHostAPI . "/wfmWebApi/api/block";
                                    $content = "{'HrId': '$hr_id'}";
                                    $response = new HttpAdapter();
                                    $block = $response->post($url, $content);
                                    if ($block['code'] == 200 || $block['code'] == 201 || $block['code'] == 202) {
                                        $_SESSION['error'] = "Błędne logowanie - Konto zablokowane";
                                    }
                                } else {
                                    $code = $wynik['code'];
                                    $massage = isset($wynik['body']->message) ? " : " . $wynik['body']->message : "";
                                    $_SESSION['error'] = "Błąd $code $massage";
                                    $this->Log("Logowanie: " . $_SESSION['error'], "ERROR", $hr_id);
                                }
                            } else {
                                $code = $wynik['code'];
                                $massage = isset($wynik['body']->message) ? " : " . $wynik['body']->message : "";
                                $_SESSION['error'] = "Błąd $code $massage";
                                $this->Log("Logowanie: " . $_SESSION['error'], "ERROR", $hr_id);
                            }
                            return header("Location: " . $this::$protocolAndHost . "/Login");
                        }
                    }
                } catch (\Exception $e) {
                    //  return
                    $_SESSION['error'] = $e->getMessage();
                    return header("Location: " . $this::$protocolAndHost . "/Login");
                }


                //  $login = addslashes($hr_id);
                //  $pass = addslashes($_POST['password']); //"Is your name O'reilly?";  zwróci: Is your name O\'reilly?

                /*

                  // var_export($hr_id);
                  // exit();
                  if ($hr_id == 'P111111' && $pass == '1111') {
                  $_SESSION['token'] = 'qweqweqeqweqeqe';
                  $_SESSION['hrId'] = addslashes($_POST['login']);
                  $_SESSION['firstName'] = 'Krzysiek';
                  $_SESSION['LAST_ACTIVITY'] = time();

                  return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/API/HOME");
                  } else {
                  $code = "Login lub Hasło jest nieprawidłowe";
                  // $massage = isset($wynik['body']->message) ? " : " . $wynik['body']->message : "";
                  $_SESSION['error'] = "Błąd: $code";
                  return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/Login/VIEW");
                  }
                 */
            } else {
                $_SESSION['error'] = "Wprowadź dane";
                return header("Location: " . $this::$protocolAndHost . "/Login");
            }
        }
    }

    public function Logout() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        return header("Location: " . $this::$protocolAndHost . "/Login");
    }

    public function ErrorAccess($param = array()) {

        return require_once __DIR__ . '/../Views/ErrorAccess.php';
    }

    public function Error404($param = array()) {

        return require_once __DIR__ . '/../Views/Error404.php';
    }

}
