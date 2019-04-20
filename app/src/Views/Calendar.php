<?php
date_default_timezone_set('Europe/Warsaw');
//$mainPublicCatalog = "http://" . $_SERVER['SERVER_NAME'] . "/calendar/Public";
//echo $this::$protocolHostAndLokAPI;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<title>e-Pracownik</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="<?php echo $this::$assetsPath; ?>/css/menu.css" rel="stylesheet" type="text/css" media="all" />
       
        <link href="<?php echo $this::$assetsPath; ?>/css/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $this::$assetsPath; ?>/css/calendar.css" rel="stylesheet" >
        <link rel="stylesheet" href="<?php echo $this::$assetsPath; ?>/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="<?php echo $this::$assetsPath; ?>/alertifyjs/css/alertify.min.css" />
        <link rel="stylesheet" href="<?php echo $this::$assetsPath; ?>/alertifyjs/css/themes/default.min.css" />
         <link href="<?php echo $this::$assetsPath; ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />

    </head>

    <body>
        <div class="container">  
            <div class="row">
                <div class="head col-md-18">
                    <div class="logo col-md-5"><img src="<?php echo $this::$assetsPath; ?>/img/logoCBB2.png" height="75" width="130" alt="CBB"></div>
                    <div class="col-md-4" id="powitanie"><h2>Witaj <?php echo $_SESSION['firstName'] ?>!</h2></div>
                    <div class="col-md-3"  style="padding: 18px;text-align: right"><a href='<?php echo $this::$protocolAndHost; ?>/Login/Logout' style="font-size:18px;" class='btn btn-warning'>Wyloguj <span style="font-size:18px;" class="glyphicon glyphicon-off" aria-hidden="true"></span> </a></div>
                </div>
            </div>

            <div id="page-header" class="page-header">

                <div id='cssmenu' class="col-md-18">
                    <ul>
                        <li><a href='Home'><span>Strona główna</span></a></li>
                        <li class='active'><a href='Calendar'><span>Kalendarz</span></a></li>
                        <li><a href='Contact'><span>Kontakt</span></a></li>
                        <li><a href='Help'><span>Pomoc</span></a></li>
                        <li class="mobileLogOut"><a href='<?php echo $this::$protocolAndHost; ?>/Login/Logout' ><span>Wyloguj</span><span style="color:white;font-size:25px;text-align:right;position: absolute;right: 15px;top:10px" class="glyphicon glyphicon-off" aria-hidden="true"></span> </a></li>
                    </ul>
                </div>
                <div class="row" style="padding: 10px 0px 0px 20px;background-color: white">
                    <div class="form-inline">
                        <div class="btn-group" style="float: left">
                            <button class="btn btn-warning" data-calendar-nav="prev"><< Poprzedni</button>
                            <button class="btn" data-calendar-nav="today">Aktualny</button>
                            <button class="btn btn-warning" data-calendar-nav="next">Następny >></button>
                        </div>
                        <div style="float: left;position: relative;bottom: 10px;padding-left: 5px">
                            <h3 style="text-align: center;font-size:18px"></h3>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="header-fixed-calendar"></div>
            <div class="row">
                <div class="span9">

                    <div id="calendar"></div>

                </div>

                <div id="sandPreferences" class="col-md-6 col-md-offset-5"></div>

            </div>
        </div>

        <!--  <a data-toggle="modal" href="#myModal">Open Modal</a>-->
        <!-- Modal -->
        <div class="modal fade" id="preferencesModal" tabindex="-1" role="dialog" aria-labelledby="preferencesModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Złóż preferencje</h4>
                    </div>
                    <form id="form-day-preferences">
                        <div class="modal-body">  

                            <div class="form-group">
                                <label for="datetimepicker1">Data od</label>
                                <div class='input-group date col-md-6' id='datetimepicker1'>

                                    <input readonly="true" id="DateFrom" name="DateFrom" type='text' class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="datetimepicker1">Data do</label>
                                <div class='input-group date col-md-6' id='datetimepicker2'>

                                    <input readonly="true" id="DateTo" name="DateTo" type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class='input-group col-md-6'>
                                    <select name="Types" id="Types"  class="form-control">
                                        <option value="">Wybierz</option>
                                        <option value="p">Praca</option>
                                        <option value="u" class="etat">Urlop</option>
                                        <option value="w" class="etat">Dzień Wolny</option>
                                        <option value="n" class="etat">Nocka</option>                                      
                                    </select>
                                </div>
                            </div>

                            <div class="form-group timeFrom" style="display: none" >
                                <label for="datetimepicker3">Czas od</label>
                                <div class='input-group date col-md-6' id='datetimepicker3'>

                                    <input readonly="true" id="TimeFrom" name="TimeFrom" type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group timeTo" style="display: none">
                                <label for="datetimepicker4">Czas do</label>
                                <div class='input-group date col-md-6' id='datetimepicker4'>

                                    <input readonly="true" id="TimeTo" name="TimeTo" type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>


                            <div class="input-group checkbox">
                                <label>
                                    <input id="Priority" name="Priority" type="checkbox" value="">
                                    Priorytet wysoki
                                </label>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>                        
                            <button id="setPreferences" type="button" class="btn btn-warning">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL EVENNTS-->

        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Zdarzenia</h4>
                    </div>
                    <div class="modal-body" >
                        <div id="cal-slide-content" class="cal-event-list">
                            <ul class="unstyled list-unstyled" id="eventsLi">
                                
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                       
                    </div>

                </div>
            </div>
        </div>
        <!-- END MODAL EVENTS -->


        <!-- MODAL SEATS-->

        <div class="modal fade" id="seatModal" tabindex="-1" role="dialog" aria-labelledby="seatModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Stanowiska</h4>
                    </div>
                    <div class="modal-body" id="seatsBody">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                       
                    </div>

                </div>
            </div>
        </div>
        <!-- END MODAL Seats -->

        <!-- Modal -->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <span id="hiddenCountPreferences" style="visibility:hidden"></span>

        <div class="load"><!-- Place at bottom of page --></div>
    </body>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/menu.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/bootstrap/bootstrap.min.js"></script>  
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/moment-with-locales.min.js"></script> 
    <script type="text/javascript">
        moment.locale('pl');
    </script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/components/jstimezonedetect/jstz.min.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/calendar/language/pl-PL.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/calendar/language/ru-RU.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/calendar/calendar.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/components/underscore/underscore-min.js"></script> 
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/alertifyjs/alertify.min.js"></script>

    <script type="text/javascript">var now = "<?= $now ?>";
        var hrId = "<?= isset($_SESSION['hrId']) ? $_SESSION['hrId'] : "brak_sesji" ?>";
        var tmplPath = "<?= $this::$tmplPath ?>";
    </script>

    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/script.js"></script> 
    <script type="text/javascript">

        /*alertify.success('Current delay : ' + alertify.get('notifier','delay') + ' seconds');
         alertify.set('notifier','delay', delay);*/
        alertify.defaults = {
            // dialogs defaults
            autoReset: true,
            basic: false,
            closable: true,
            closableByDimmer: true,
            frameless: false,
            maintainFocus: true, // <== global default not per instance, applies to all dialogs
            maximizable: true,
            modal: true,
            movable: true,
            moveBounded: false,
            overflow: true,
            padding: true,
            pinnable: true,
            pinned: true,
            preventBodyShift: false, // <== global default not per instance, applies to all dialogs
            resizable: true,
            startMaximized: false,
            transition: 'pulse',

            // notifier defaults
            notifier: {
                // auto-dismiss wait time (in seconds)  
                delay: 0,
                // default position
                position: 'bottom-right',
                // adds a close button to notifier messages
                closeButton: true
            },

            // language resources 
            glossary: {
                // dialogs default title
                title: 'AlertifyJS',
                // ok button text
                ok: 'OK',
                // cancel button text
                cancel: 'Cancel'
            },

            // theme settings
            theme: {
                // class name attached to prompt dialog input textbox.
                input: 'ajs-input',
                // class name attached to ok button
                ok: 'ajs-ok',
                // class name attached to cancel button 
                cancel: 'ajs-cancel'
            }
        };

    </script> 

    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<script> $(document).ready(function() {                             
                                    alertify.error('$error');
                                    
                              }); </script>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['ok']) && !empty($_SESSION['ok'])) {
        $ok = $_SESSION['ok'];
        echo "<script> $(document).ready(function() {      
                                alertify.success('$ok');
                              }); </script>";
        unset($_SESSION['ok']);
    }
    ?>
</html>