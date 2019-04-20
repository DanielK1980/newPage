<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>                   
          <?php  if(isset($_GET['error'])) echo PHP_EOL.$_GET['error'];   ?>
            
            
        </p>
        
        <div style="width:864px; height: 578px;margin: 0 auto">
            <h1 style="text-align: center">Strona nie istnieje - błąd 404</h1>
            <img src="<?php echo $this::$assetsPath.'/img/404.png' ?>" alt="404" height="578" width="864">
            
        </div>
    </body>
</html>