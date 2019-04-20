<?php
date_default_timezone_set('Europe/Warsaw');
//$this::$assetsPath = "http://" . $_SERVER['SERVER_NAME'] . "/calendar/Public";
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
        <link rel="stylesheet" href="<?php echo $this::$assetsPath; ?>/alertifyjs/css/alertify.min.css" />
          <link href="<?php echo $this::$assetsPath; ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="head col-md-18">
                    <div class="logo col-md-5"><img src="<?php echo $this::$assetsPath ?>/img/logoCBB2.png" height="75" width="130" alt="CBB"></div>
                    <div class="col-md-4" id="powitanie"><h2>Witaj <?php echo $_SESSION['firstName'] ?>!</h2></div>
                    <div class="col-md-3"  style="padding: 18px;text-align: right"><a href='<?php echo $this::$protocolAndHost; ?>/Login/Logout' style="font-size:18px;" class='btn btn-warning'>Wyloguj <span style="font-size:18px;" class="glyphicon glyphicon-off" aria-hidden="true"></span> </a></div>
                </div>
            </div>

            <div id="page-header" class="page-header">

                <div id='cssmenu' class="col-md-18">
                    <ul>
                        <li><a href='Home'><span>Strona główna</span></a></li>
                        <li><a href='Calendar'><span>Kalendarz</span></a></li>
                        <li class='active'><a href='Contact'><span>Kontakt</span></a></li>
                         <li><a href='Help'><span>Pomoc</span></a></li>
                        <li class="mobileLogOut"><a href='<?php echo $this::$protocolAndHost; ?>/Login/Logout' ><span>Wyloguj</span><span style="color:white;font-size:25px;text-align:right;position: absolute;right: 15px;top:10px" class="glyphicon glyphicon-off" aria-hidden="true"></span> </a></li>
                    </ul>
                </div>

            </div>
            <div class="header-fixed"></div>
            <div class="col-md-6 col-md-offset-3" style="padding: 0px">

                <div style="padding: 5px">
                    <?php if (!empty($Contacts)) { ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Przełożony / Dział</th>
                                    <th>Telefon</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($Contacts->Contacts as $key => $value) {

                                    $phoneMobile = !empty($value->MobilePhone) ? "<a href='tel:$value->MobilePhone' class='btn btn-warning'><span style='' class='glyphicon glyphicon-phone' aria-hidden='true'></span>  $value->MobilePhone</a>" : "";
                                    $phoneAlt = !empty($value->Phone) ? "<a href='tel:$value->Phone' class='btn btn-warning'><span style='' class='glyphicon glyphicon-phone-alt' aria-hidden='true'></span>  $value->Phone</a>" : "";

                                    echo "<tr>
                                  <td>$value->Name</td>
                                  <td style='text-align:center'><p>$phoneAlt</p> <p> $phoneMobile</p></td>
                                  
                                </tr>";
                                }

                                //$Contacts->Contacts[0]->Name
                                ?>
                            </tbody>

                        </table>
                    <?php } ?>
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
    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<script> $(document).ready(function() {      
                                alertify.error('$error');
                              }); </script>";
        unset($_SESSION['error']);
    }
    ?>
</html>