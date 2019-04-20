<?php
date_default_timezone_set('Europe/Warsaw');
//$this::$assetsPath = "http://" . $_SERVER['SERVER_NAME'] . "/calendar/Public";
//echo $this::$protocolAndHostAPI;
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
       
        <link href="<?php echo $this::$assetsPath; ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
         <link rel="stylesheet" href="<?php echo $this::$assetsPath; ?>/alertifyjs/css/alertify.min.css" />
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
                        <li class='active'><a href='Home'><span>Strona główna</span></a></li>
                        <li><a href='Calendar'><span>Kalendarz</span></a></li>
                        <li><a href='Contact'><span>Kontakt</span></a></li>
                        <li><a href='Help'><span>Pomoc</span></a></li>
                        <li class="mobileLogOut"><a href='<?php echo $this::$protocolAndHost; ?>/Login/Logout' ><span>Wyloguj</span><span style="color:white;font-size:25px;text-align:right;position: absolute;right: 15px;top:10px" class="glyphicon glyphicon-off" aria-hidden="true"></span> </a></li>
                    </ul>
                </div>

            </div>
            
             <div class="header-fixed"></div>
            
            <div class="col-md-12" style="margin-top:15px;padding: 15px">
                <p><strong><span style="font-size: 12.0pt; line-height: 107%; font-family: 'Verdana','sans-serif';">Witaj w platformie e-Pracownik!</span></strong></p>
                <p style="text-align: justify;"><span style="font-family: 'Verdana','sans-serif';">Dzięki tej aplikacji możesz sprawdzić swoje zaplanowanie, przydzielone stanowisko jak r&oacute;wnież złożyć preferencje na kolejny miesiąc &ndash; r&oacute;wnież w domu, na telefonie lub tablecie!</span></p>
                <p style="text-align: justify;"><span style="font-family: 'Verdana','sans-serif';">Możesz r&oacute;wnież, w sytuacji tego wymagającej, zadzwonić do Lider&oacute;w, Przełożonego oraz Kadr i Trener&oacute;w.</span></p>
                <p style="text-align: justify;"><span style="font-family: 'Verdana','sans-serif';">Platforma będzie stale rozwijana, a już niedługo będą dodane dodatkowe funkcje. W razie pytań lub wątpliwości, zapoznaj się z <a href="<?php echo $this::$assetsPath; ?>/files/Instrukcja.pdf" target="_blank">instrukcją</a> oraz <a href="<?php echo $this::$assetsPath; ?>/files/Regulamin.pdf" target="_blank">regulaminem</a>.</span></p>
            </div>
        </div>
        
            <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                                      <div class="modal-header">
                        
                                          <h4 class="modal-title" id="myModalLabel"><?php echo $name; ?>,<br> <br>jak Ci minął Twój dzień pracy ? <br> Podziel się z nami swoją emocją.</h4><br>
                    </div>
                    <div class="modal-body" >
                      <div class="row">
                       <div  class="col-lg-4 col-md-4 col-xs-4 xs-text-center"> 
                           <a class="apopup" data="2" href="#"><img src="<?php echo $this::$assetsPath; ?>/img/popup/01.jpg"></a>
                       </div>                        
                        <div class="col-lg-4 col-md-4 col-xs-4 xs-text-center">
                            <a class="apopup" data="1" href="#"><img src="<?php echo $this::$assetsPath; ?>/img/popup/02.jpg"></a>
                        </div>                     
                        <div class="xs-text-center"> 
                            <a class="apopup" data="nie" href="#"><img src="<?php echo $this::$assetsPath; ?>/img/popup/03.jpg"></a>
                        </div>  
                      </div>
                    </div>
                    <div class="modal-footer">

                    </div>

                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/menu.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/bootstrap/bootstrap.min.js"></script>  
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/moment-with-locales.min.js"></script> 
    <script type="text/javascript">
        moment.locale('pl');
    </script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/components/jstimezonedetect/jstz.min.js"></script>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/bower_components/moment/min/moment.min.js"></script>    
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/alertifyjs/alertify.min.js"></script>
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
     if (isset($_SESSION['popUp']) && !empty($_SESSION['popUp']) && $_SESSION['popUp'] ==1) {
       
        echo "<script> $(document).ready(function() {      
                            $('#popupModal').modal({backdrop:'static', keyboard:false});   
                            $('#popupModal').modal('show');
                            
                                

                              }); </script>";
       
    }
    ?>
    <script type="text/javascript" src="<?php echo $this::$assetsPath; ?>/js/popup.js"></script>
</html>