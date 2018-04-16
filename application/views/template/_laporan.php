<?php
date_default_timezone_set("Singapore");
?>

<html>
    <head>
        <style type="text/css">
            .headline { 
                font-size: 24px;
                font-weight: bold;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color:#000033;
                padding: 3px;
            } 
            .daftar { 
                font-size: 12px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color:#000033;
                padding: 3px;
            } 

            .ttd { 
                font-size: 12px;
                font-weight: bold;
                padding: 3px;
            } 
            table { padding: 18px; padding-top: 0px; }
            table h3 {
                font-size: 20px;
                font-weight: bold;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color:#000033;
                padding: 3px;
            }
            
        </style>
    </head>
   <body onload="window.print()"> 
     <!-- <body>-->
        <?= $contents ?>
    </body>
</html>

