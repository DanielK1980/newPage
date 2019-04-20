<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace src\Controllers;

use src\Interfaces\ApiInterface;
use src\Exception\ResponseException;
use src\Adapter\HttpAdapter;
use src\Config;

/**
 * Description of API
 *
 * @author Daniel
 */
class APIController extends Config implements ApiInterface {

    private $config;

    public function __construct() {
        parent::__construct();
    }

    public function Help($param = array()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['token']) &&
                !isset($_SESSION['hrId']) &&
                !isset($_SESSION['firstName'])) {
            $_SESSION['error'] = "Twoja sesja wygasła - proszę się zalogować";
            return header("Location: " . $this::$protocolAndHost . "/Login/VIEW");
        } {
            return require_once __DIR__ . '/../Views/Help.php';
        }
    }

    public function PopUp($param = array()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $face = isset($param[0]) && !empty($param[0]) ? $param[0] : "";
        $hr_id = $_SESSION['hrId'];      

        if ($face) {     
            $data = $face == "nie" ? 0 : $face;
            $url = "" . $this::$protocolHostAndLokAPI . "/api/nps";
            $content = "{'HrId': '$hr_id','NpsResult': $data}";
            $response = new HttpAdapter($_SESSION['token']);
            $wynik = $response->post($url, $content);           
                    
            if (!empty($wynik)){
                if ($wynik['code'] == 200 || $wynik['code'] == 201 || $wynik['code'] == 202) {
                          /*   'Dziękujemy ! <br> Twoja ocena została zapisana'    */     
                        if (isset($wynik['body']->message) && !empty($wynik['body']->message)) {
                            $massage = $wynik['body']->message;
                            unset($_SESSION['popUp']);
                            echo json_encode(array('error' => $massage));
                            return;                          
                        }
                        unset($_SESSION['popUp']);
                        echo json_encode(array('ok' => "Dziękujemy ! <br> Twoja ocena została zapisana"));
                        return;                        
                                     
                } else {
                    echo json_encode(array("error" => "Błąd: " . $wynik['code']));
                    return;
                }
            }
        }else{
             echo json_encode(array("error" => "Błąd: brak prawidłowych danych wejściowych"));
        }
    }

    public function Home($param = array()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $name = $_SESSION['firstName'];
        if (!isset($_SESSION['token']) &&
                !isset($_SESSION['hrId']) &&
                !isset($_SESSION['firstName'])) {
            $_SESSION['error'] = "Twoja sesja wygasła - proszę się zalogować";
            return header("Location: " . $this::$protocolAndHost . "/Login/VIEW");
        } {
            return require_once __DIR__ . '/../Views/Home.php';
        }
    }

    public function Contact($param = array()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
        }
        $Contacts = "";

        if (!isset($_SESSION['token']) &&
                !isset($_SESSION['hrId']) &&
                !isset($_SESSION['firstName'])) {
            $_SESSION['error'] = "Twoja sesja wygasła - proszę się zalogować";
            return header("Location: " . $this::$protocolAndHost . "/Login/VIEW");
        } else {
            $hr_id = $_SESSION['hrId'];
            $url = "" . $this::$protocolHostAndLokAPI . "/api/contacts/get";
            $content = "{'HrId': '$hr_id'}";

            $response = new HttpAdapter($_SESSION['token']);
            $wynik = $response->post($url, $content);

            if (!empty($wynik)) {
                if ($wynik['code'] == 200 || $wynik['code'] == 201 || $wynik['code'] == 202) {
                    if (isset($wynik['body'])) {
                        $Contacts = json_decode($wynik['body']);
                    }
                    // var_export($Contacts->Contacts[0]->Name);
                    // exit();
                }
            }
        }
        return require_once __DIR__ . '/../Views/Contact.php';
    }

    public function Calendar($param = array()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
        }

        if (!isset($_SESSION['token']) &&
                !isset($_SESSION['hrId']) &&
                !isset($_SESSION['firstName'])) {
            $_SESSION['error'] = "Twoja sesja wygasła - proszę się zalogować";
            return header("Location: " . $this::$protocolAndHost . "/Login/VIEW");
        } else {

            if (isset($param['DateStart']) && $param['DateStart'] != "now") {
                $timestampFrom = (float) $param['DateStart'] / 1000;
                $timestamp = (int) $timestampFrom;
                $dt = new \DateTime();
                $dt->setTimeZone(new \DateTimeZone('Europe/Warsaw'));
                $dt->setTimestamp($timestamp);
                $now = $dt->format('Y-m-d');
            } else {
                $now = "now";
            }

            /*
              $hrId = $_SESSION['hrId'];
              $token = $_SESSION['token'];
              $start = new DateTime('first day of this month');
              $startFormat = $start->format('Y-m-d');

              $last = new DateTime('last day of this month');
              $lastFormat = $last->format('Y-m-d');
              $url = "http://localhost:53137/api/calendars/$hrId/events?begin=$startFormat&end=$lastFormat";

              $response = new HttpAdapter($token);

              $wynik = $response->get($url);
              if (isset($wynik['error'])) {
              $_SESSION['error'] = $wynik['error'][0];
              return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/Login/VIEW");
              } else {
             * 
             */
            return require_once __DIR__ . '/../Views/Calendar.php';
            // }
        }
    }

    public function getEvents($param = array()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        /* PARAM
         * array (
          'from' => '1541026800000',
          'to' => '1543618800000',
          'utc_offset_from' => '-60',
          'utc_offset_to' => '-60',
          'browser_timezone' => 'Europe/Berlin',
          )
         * */
        /*
          $timestampFrom = (float) $param['from'] / 1000;
          $timestamp = (int) $timestampFrom;
          $dt = new \DateTime();
          $dt->setTimeZone(new \DateTimeZone('Europe/Warsaw'));
          $dt->setTimestamp($timestamp);
          $wynik1 = $dt->format('Y-m-d');

          var_export($wynik1);
          echo "<br>";

          $timestampFrom2 = (float) $param['to'] / 1000;
          $timestamp2 = (int) $timestampFrom2;
          $dt2 = new \DateTime();
          $dt2->setTimeZone(new \DateTimeZone('Europe/Warsaw'));
          $dt2->setTimestamp($timestamp2);
          $wynik2 = $dt->format('Y-m-d');
         */
        //  var_export($wynik2);
        /* date_default_timezone_set('Europe/Warsaw');
          $timestampFrom = (float)$param['from'] / 1000;
          $timestamp = (int)$timestampFrom;
          var_export($timestamp);
          echo '<br>';
          var_export(gmdate("Y-m-d", (int)$timestamp)); */
        // exit();
        /*
          $events = '{
          "success": 1,
          "result": [
          {
          "id": "293",
          "title": "This is warning class event with very long title to check how it fits to evet in day view",
          "url": "",
          "class": "event-warning",
          "start": "1546326000000",
          "end":   "1546358400000"
          },
          {
          "id": "256",
          "title": "Event that ends on timeline",
          "url": "",
          "class": "event-warning",
          "start": "1541602800000",
          "end":   "1541613600000"
          },
          {
          "id": "276",
          "title": "Short day event",
          "url": "#",
          "class": "event-success",
          "start": "1546329600000",
          "end":   "1546358400000"
          },
          {
          "id": "294",
          "title": "This is information class ",
          "url": "#",
          "class": "event-info",
          "start": "1363111200000",
          "end":   "1363284086400"
          },
          {
          "id": "297",
          "title": "This is success event",
          "url": "#",
          "class": "event-success",
          "start": "1363234500000",
          "end":   "1363284062400"
          },
          {
          "id": "54",
          "title": "This is simple event",
          "url": "#",
          "class": "",
          "start": "1363712400000",
          "end":   "1363716086400"
          },
          {
          "id": "532",
          "title": "This is inverse event",
          "url": "#",
          "class": "event-inverse",
          "start": "1364407200000",
          "end":   "1364493686400"
          },
          {
          "id": "548",
          "title": "This is special event",
          "url": "#",
          "class": "event-special",
          "start": "1363197600000",
          "end":   "1363629686400"
          },
          {
          "id": "295",
          "title": "Event 3",
          "url": "http://www.example.com/",
          "class": "event-important",
          "start": "1364320800000",
          "end":   "1364407286400"
          }
          ]

          }';
         */
        $events = "";
        //{"wynik":[{"Day":"2018-06-13","Work":[{"Type":"1","TimeStart":"08:00","TimeEnd":"16:00"},{"Type":"dg","TimeStart":"16:00","TimeEnd":"17:00"}]},{"Day":"2018-06-14","Work":[{"Type":"1","TimeStart":"08:00","TimeEnd":"18:00"}]},{"Day":"2018-06-15","Work":[{"Type":"1","TimeStart":"08:00","TimeEnd":"18:00"}]},{"Day":"2018-05-15","Work":[{"Type":"1","TimeStart":"08:00","TimeEnd":"18:00"}]}]}
        // echo $events;
        /*
          if (isset($_SESSION['token']) &&
          isset($_SESSION['hrId']) &&
          isset($_SESSION['firstName'])) {

          $hrId = $_SESSION['hrId'];
          $token = $_SESSION['token'];
          $start = new DateTime('first day of this month');
          $startFormat = $start->format('Y-m-d');

          $last = new DateTime('last day of this month');
          $lastFormat = $last->format('Y-m-d');
          $url = "http://localhost:53137/api/calendars/$hrId/events?begin=$startFormat&end=$lastFormat";

          $response = new HttpAdapter($token);

          $wynik = $response->get($url);
          if (isset($wynik['error'])) {
          $error = $wynik['error'][0];
          return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/Login/VIEW");
          // return require_once __DIR__ . '/../Views/Login.php';
          } else {
          return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/API/VIEW/");
          // return require_once __DIR__ . '/../Views/Calendar.php';
          // var_export($wynik);
          }
          } else {
          $error = "Proszę się zalogować";
          return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/Login/VIEW");
          } */
    }

    public function getGrafik($param = array()) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
        }

        if (!isset($_SESSION['token']) &&
                !isset($_SESSION['hrId']) &&
                !isset($_SESSION['firstName'])) {
            //$_SESSION['error'] = "Twoja sesja wygasła - proszę się zalogować";

            echo json_encode(array('endsassion' => true));
            // return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/Login/VIEW");
        } else {

            $hr_id = $_SESSION['hrId'];
            $dateBeg = $param['datestart'];
            $dateEnd = $param['dateend'];

            $url = "" . $this::$protocolHostAndLokAPI . "/api/calendars/$hr_id/calendar/";
            $content = "{'HrId': '$hr_id','DateBeg':'$dateBeg','DateEnd':'$dateEnd'}";

            $response = new HttpAdapter($_SESSION['token']);
            $wynik = $response->post($url, $content);

            //    var_export($wynik['body']);
            //   exit();
            if (!empty($wynik)) {
                if ($wynik['code'] == 200 || $wynik['code'] == 201 || $wynik['code'] == 202) {
                    echo $wynik['body'];
                }
            }
            /*
              echo '{
              "EmployeeName": "Daniel",
              "WorkDayNumber": 22,
              "ContractType": "e",
              "CalendarItems": [{
              "Day": "2019-01-01",
              "IsHoliday": 1,
              "Work": [                {
              "Type": "1",
              "TimeStart": "08:00",
              "TimeEnd": "16:00",
              "HexColor": "#f0ad4e"
              },
              {
              "Type": "sz",
              "TimeStart": "16:00",
              "TimeEnd": "17:00",
              "HexColor": "#84dadb"
              },
              {
              "Type": "1",
              "TimeStart": "08:00",
              "TimeEnd": "16:00",
              "HexColor": "#f0ad4e"
              },
              {
              "Type": "1",
              "TimeStart": "08:00",
              "TimeEnd": "16:00",
              "HexColor": "#f0ad4e"
              }],
              "PreferenceStat": "0",
              "Preferences": null,
              "SeatState": "1",
              "Seats": [{
              "SeatName": "L120",
              "Time": "08:00-09:00"
              }, {
              "SeatName": "L130",
              "Time": "10:00-14:00"
              }],
              "EventsStat": "1",
              "Events": [{
              "Id": "293",
              "Title": "This is warning class event with very long title to check how it fits to evet in day view",
              "Url": "",
              "Class": "event-warning",
              "Time": "13:00-14:00"
              },
              {
              "Id": "276",
              "Title": "Short day event",
              "Url": "",
              "Class": "event-success",
              "Time": "14:00-16:00"
              }]
              },
              {
              "Day": "2019-01-02",
              "IsHoliday": 0,
              "Work": [                {
              "Type": "1",
              "TimeStart": "08:00",
              "TimeEnd": "16:00",
              "HexColor": "#f0ad4e"
              },
              {
              "Type": "sz",
              "TimeStart": "16:00",
              "TimeEnd": "17:00",
              "HexColor": "#84dadb"
              },
              {
              "Type": "1",
              "TimeStart": "08:00",
              "TimeEnd": "16:00",
              "HexColor": "#f0ad4e"
              },
              {
              "Type": "1",
              "TimeStart": "08:00",
              "TimeEnd": "16:00",
              "HexColor": "#f0ad4e"
              }],
              "PreferenceStat": "0",
              "Preferences": null,
              "SeatState": "1",
              "Seats": [{
              "SeatName": "L125",
              "Time": "09:00-12:00"
              }, {
              "SeatName": "L135",
              "Time": "15:00-16:00"
              }],
              "EventsStat": "1",
              "Events": [{
              "Id": "293",
              "Title": "events z dnia 02-01-2018",
              "Url": "",
              "Class": "event-warning",
              "Time": "12:30-14:30"
              },
              {
              "Id": "276",
              "Title": "Short day event z dnia 02-01-2018",
              "Url": "",
              "Class": "event-success",
              "Time": "13:00-00:00"
              }]
              },{
              "Day": "2019-01-03",
              "IsHoliday": 0,
              "Work": [],
              "PreferenceStat": "1",
              "Preferences": null,
              "SeatState": "0",
              "Seats": [],
              "EventsStat": "0",
              "Events": []
              },{
              "Day": "2019-01-04",
              "IsHoliday": 0,
              "Work": [],
              "PreferenceStat": "0",
              "Preferences": null,
              "SeatState": "0",
              "Seats": [],
              "EventsStat": "1",
              "Events": [{
              "Id": "293",
              "Title": "qqqqqqqqqq",
              "Url": "",
              "Class": "event-warning",
              "Time": "05:00-06:00"
              },
              {
              "Id": "276",
              "Title": "śśśśśśśśt",
              "Url": "",
              "Class": "event-success",
              "Time": "06:00-07:00"
              }]
              },{
              "Day": "2019-01-05",
              "IsHoliday": 0,
              "Work": [],
              "PreferenceStat": "1",
              "Preferences": null,
              "SeatState": "1",
              "Seats": [{
              "SeatName": "L999",
              "Time": "08:00-14:00"
              }, {
              "SeatName": "L888",
              "Time": "14:00-15:00"
              }],
              "EventsStat": "0",
              "Events": []
              }
              ]
              }'; */
        }
    }

    public function SavePreferences($param = array()) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['jsonPreferences']) && !empty($_POST['jsonPreferences'])) {
            $content = $_POST['jsonPreferences'];
            // $now = isset($param['DateStart']) && !empty($param['DateStart']) ? $param['DateStart'] : "now";
            /*
              if ($Types == "p" && (empty($TimeTo) || empty($TimeFrom))) {
              $_SESSION['error'] = "Nie wybrano czasu pracy";
              return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/API/Calendar?DateStart=" . $now . "");
              }
             */

            $url = "" . $this::$protocolHostAndLokAPI . "/api/calendars/preferences/save";
            /*
              var_export($content);

              exit();
             */
            try {

                $response = new HttpAdapter($_SESSION['token']);

                $wynik = $response->post($url, $content);

                if (!empty($wynik)) {
                    //$response = json_decode($wynik);  
                    // var_export($wynik);

                    if ($wynik['code'] == 200 || $wynik['code'] == 201 || $wynik['code'] == 202) {

                        if (isset($wynik['body']->message) && !empty($wynik['body']->message)) {

                            $massage = $wynik['body']->message;

                            //$_SESSION['error'] = $massage;
                            echo json_encode(array('error' => $massage));
                            return;
                            //return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/API/Calendar?DateStart=" . $now . "");
                        }

                        echo json_encode(array('ok' => "Zapisano preferencje"));
                        return;
                        // $_SESSION['token'] = $wynik['body']->token;
                        // $_SESSION['hrId'] = $wynik['body']->hrId;
                        // $_SESSION['firstName'] = $wynik['body']->firstName;
                        //$_SESSION['ok'] = "Zapisaono preferencje";
                        //return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/API/Calendar?DateStart=" . $now . "");
                        // $API = new APIController();
                        // return $API->View(); //$API->getGrafikOnLoad($wynik['body']->firstName, $wynik['body']->hrId, $wynik['body']->token);
                    } else {
                        $code = $wynik['code'];
                        $massage = isset($wynik['body']->message) ? " : " . $wynik['body']->message : "";
                        $error = "Błąd $code $massage";
                        echo json_encode(array('error' => $error));
                        return;

                        //return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/Login/VIEW");
                    }
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            echo json_encode(array('error' => "Błąd wysłania danych"));
            return;
            //  var_export($_SESSION['error']);
            //exit();
            //return header("Location: http://" . $_SERVER['SERVER_NAME'] . "/calendar/API/VIEW");
        }
    }

}
