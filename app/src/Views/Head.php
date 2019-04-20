<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="pl"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="pl"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="pl"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pl">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <base href="http://rejestrinfo.pl" />
  
        <meta name="robots" content="index,follow"/>
    
        <meta name="google-site-verification" content="a7_lpcRkcqO18KcF-k_CrkIow606-EqveV-Jqk2dbHQ" />     
	<meta name="Description" content="<?php if((isset($_GET['go']) && $_GET['go']=='odpisy-krs-kw') || !isset($_GET['go'])){echo "Zamów fotokopie akt KRS z całej Polski. Odpisy z KRS lub KW do 24h. Zamów już dziś !";}
	else if($_GET['go']=='zamow-krs-kw'){echo "Zamów odpis KRS lub KW online. Dostawa do 24h na twoje biurko";}	
    else if($_GET['go']=='kopia-akt-rejestrowych'){echo "Zamów fotokopie dokumentów z akt rejestrowych takich jak sprawozdania finansowe, umowy, statuty, uchwały itp.";}
    else if($_GET['go']=='fotokopia-sprawozdan-finansowych-z-akt'){echo "Fotokopie sprawozdań finansowych i innych dokumentów z akt rejestrowych do 7 dni na twój adres e-mail";}?>"/>
	<meta name="Keywords" content="<?php if((isset($_GET['go']) && $_GET['go']=='odpisy-krs-kw') || !isset($_GET['go'])){echo "fotokopie akt krs,fotokopie krs,krs, odpisy z krajowego rejestru sądowego, odpisy z kw,odpisy krs, odpisy z ksiąg wieczystych";}
	else if($_GET['go']=='zamow-krs-kw'){echo "zamów odpis krs, zamów odpis kw, zamawianie odpisów krs, zamawianie odpisów kw, formularz krs, formularz kw ";}
	 else if($_GET['go']=='fotokopia-sprawozdan-finansowych-z-akt'){echo "fotokopie sprawozdań finansowych, fotokopie akt rejestrowych";}
     else if($_GET['go']=='kopia-akt-rejestrowych'){echo "fotokopie akt rejestrowych, fotokopie sprawozdań finansowych";}
     ?> "/>
	<title><?php if((isset($_GET['go']) && $_GET['go']=='odpisy-krs-kw') || !isset($_GET['go'])){echo "Fotokopie akt KRS z całej Polski. Odpisy KRS i KW - rejestrinfo.pl";}
	else if($_GET['go']=='zamow-krs-kw'){echo "Zamów odpis KRS lub KW online - rejestrinfo.pl";}
    else if($_GET['go']=='kopia-akt-rejestrowych'){echo "Fotokopie akt KRS z całej Polski na twój e-mail - rejestrinfo.pl";}
    else if($_GET['go']=='fotokopia-sprawozdan-finansowych-z-akt'){echo "Fotokopie sprawozdań finansowych z akt KRS - rejestrinfo.pl";}?></title> 
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/flexslider.css">
        <link rel="stylesheet" href="css/jquery.fancybox.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/font-icon.css">
        <link rel="stylesheet" href="css/animate.min.css"> 
        <link rel="stylesheet" href="css/easyzoom.css" />
	<link rel="stylesheet" type="text/css"  href="css/lightslider.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <?php if (isset($_GET['go']) && $_GET['go'] == 14 || isset($_GET['go']) && $_GET['go'] == 10): ?>
            <link rel="stylesheet" href="css/style2.css">
        <?php endif; ?>

        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/mail.js"></script>
        
        <script type="text/javascript" src="js/jquery.validate/jquery.validate.min.js"></script>

        <?php if (isset($_GET['go']) && $_GET['go'] == 'fotokopia-sprawozdan-finansowych-z-akt'): ?>
            <script type="text/javascript" src="js/CountFotocopyPrice.js"></script>
            <script type="text/javascript" src="js/jquery.validate/WalidacjaFotocopy.js"></script>
        <?php endif; ?>

        <script type="text/javascript" src="js/jquery.validate/localization/messages_pl.min.js"></script>
        <?php if (isset($_GET['go']) && $_GET['go'] == 'zamow-krs-kw'): ?>
            <script type="text/javascript" src="js/formularzkrskw.js"></script>
            <script type="text/javascript" src="js/jquery.validate/WalidacjaOdpisy.js"></script>
        <?php endif; ?>

    </head>

    <body>
        <!-- header section -->
        <section id="fotokopie-akt-krs-odpisy" class="banner" role="banner">
            <header id="header" <?php
            if (isset($_GET['go']) && $_GET['go'] == "fotokopia-sprawozdan-finansowych-z-akt" ||
                    isset($_GET['go']) && $_GET['go'] == 14 ||
			isset($_GET['go']) && $_GET['go'] == 11 ||
			isset($_GET['go']) && $_GET['go'] == 12 ||
                    isset($_GET['go']) && $_GET['go'] == 'zamow-krs-kw' ||
                    isset($_GET['go']) && $_GET['go'] == 'kopia-akt-rejestrowych' ||
                    isset($_GET['go']) && $_GET['go'] == 10) {
                echo "class='fixed' style='position:relative'";
            }
            ?> >
                <div class="header-content clearfix"> <img class="logo" src="images/rejestrinfokopia.png"  alt="Fotokopie akt KRS i odpisy z KRS i KW" />
                    <nav class="navigation" role="navigation">
                        <ul class="primary-nav">
                            <li><a href="#fotokopie-akt-krs-odpisy">Strona główna</a></li>
                            <li><a href="#nasze-uslugi">Nasze usługi</a></li>
                            <li><a href="#o-nas">O nas</a></li> 
                            <li><a href="#cennik-fotokopii-krs-odpisow">Cennik</a></li>
                            <li><a href="#dodatkowe-informacje">FAQ</a></li>
                            <!--    <li><a href="#testimonials">Dlaczego my</a></li>-->
                            <li><a href="#contact">Kontakt</a></li>
                        </ul>
                    </nav>
                    <a href="#" class="nav-toggle">Menu<span></span></a> </div>
            </header>
            <!-- banner text --> 
        </section>
        <?php
        if (isset($_GET['go'])) {
            switch ($_GET['go']) {
                case "zamow-krs-kw":
                    include("zamow-krs-kw.html");
                    break;             
                case "regulamin":
                    include("regulamin.html");
                    break;
                case "kopia-akt-rejestrowych":
                    include("kopia-akt-rejestrowych.html");
                    break;
                case 10:
                    include("zamow.php");
                    break;
                case 11:
                    include("operacjazakonczona.html");
                    break;
                case 12:
                    include("operacjaanulowana.html");
                    break;
                case "fotokopia-sprawozdan-finansowych-z-akt":
                    include("fotokopia-sprawozdan-finansowych-z-akt.html");
                    break;

                case 14:
                    include("zamow-akta-krs.php");
                    break;

                case "odpisy-krs-kw":
                default:
                    include("odpisy-krs-kw.html");
            }
        } else {
            include("odpisy-krs-kw.html");
        }
        ?>

        <!-- contact section --> 
        <!-- Footer section -->
        <footer id="footer" class="footer">
            <div class="container">

                <div   class="col-md-6">   
               <!--	<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ2Zkppi1bFkcRHvEoYgP-Z0k&key=AIzaSyCnE1eIcgvZ0MnGufoKBv98ucnli8pUPeQ"></iframe>--> 


                    <h3 style="color:#fff;">Płatności zwykłe lub online przez serwis tpay.com</h3>
                    <br>
                    <a href="https://tpay.com/czym-jest-tpay" target="_blank" title="System płatności internetowych tpay.com"><img src="https://tpay.com/img/banners/tpay-full-color-647x162.png" style="border:0" alt="Umożliwiamy szybkie płatności internetowe za pomocą serwisu tpay.com" title="tpay.com to szybkie i wygodne płatności internetowe"  width="80%" height="80%" /> 
                    </a>
                </div>

                <div   class="col-md-2" >   
                <!--	<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ2Zkppi1bFkcRHvEoYgP-Z0k&key=AIzaSyCnE1eIcgvZ0MnGufoKBv98ucnli8pUPeQ"></iframe>--> 


                    <h3 style="color:#fff;">Nasze dane</h3>
                    <br>
                    <address style="color:#fff;">
                        <strong>MDK Daniel Kaszyk</strong><br>
                        ul. Półkole 7/22<br>
                        31-559 Kraków<br>
                        Polska<br>
                        NIP 738-181-94-03<br>
                        <abbr title="Phone">Tel:</abbr> 729-123-925
                    </address>
                    
                    © 2014 MDK Daniel Kaszyk

                </div>
				 <div   class="col-md-4" > 
				 <h3 style="color:#fff;">Facebook</h3>
				 <br>
				<div class="fb-page" 
				  data-href="https://www.facebook.com/FotokopieAktKrs"
				  data-width="280" 
				  data-height="70" 
				  data-hide-cover="false"
				  data-show-facepile="false"></div>
			</div>
            </div>
        </footer>
        <!-- Footer section --> 
        <!-- JS FILES --> 

        <script src="js/jquery.flexslider-min.js"></script> 
        <script src="js/jquery.fancybox.pack.js"></script> 
        <script src="js/retina.min.js"></script> 
        <script src="js/modernizr.js"></script> 
        <?php if (isset($_GET['go']) == false) { ?>
            <script src="js/main.js"></script> 
        <?php } ?>
        <script type="text/javascript" src="js/jquery.contact.js"></script> 
        <script type="text/javascript" src="js/jquery.devrama.slider.min-0.9.4.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.slider-banner').DrSlider({
                    'transition': 'fade',
                    showNavigation: false,
                    progressColor: "#9F1F22"
                });
                //      $('banerbtn.button span').hover(
                // function(){ $(this).addClass('glyphicon-chevron-right') },
                // function(){ $(this).removeClass('glyphicon-chevron-right') })
            });
	
        </script> 
				<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = 'https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.11';
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		

    </body>
</html>

