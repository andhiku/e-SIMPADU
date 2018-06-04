<?php
date_default_timezone_set("Singapore");
?>
<html lang="en">
    <head>
        <title><?= APPNAME; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" media="screen" href="<?= base_url() ?>files/style.css">
        <link rel="stylesheet" media="screen" href="<?= base_url() ?>files/bootstrap.css">

        <script src="<?= base_url() ?>files/jquery.min.js"></script>
        <link rel="stylesheet" href="<?= base_url() ?>files/jquery.css">
        <link rel="stylesheet" href="<?= base_url() ?>files/bootstrap/css/bootstrap.min.css">
        <script src="<?= base_url() ?>files/bootstrap/js/bootstrap.min.js"></script>

        <script language="JavaScript" type="text/javascript">
            var d = new Date();
            var monthname = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "Desember");
            //Ensure correct for language. English is "January 1, 2004"
            var TODAY = "<?= KOTA ?>, " + d.getDate() + " " + monthname[d.getMonth()] + "  " + d.getFullYear();
            //---------------   END LOCALIZEABLE   ---------------
        </script>

        <script language="javascript" type="text/javascript">
            function clearText(field)
            {
                if (field.defaultValue == field.value)
                    field.value = '';
                else if (field.value == '')
                    field.value = field.defaultValue;
            }
        </script>       
        <script>
            jamS = new Date("<?= date("Y m d H:i:s") ?>");
            jamL = new Date();
            jamD = jamS - jamL;
            function show() {
                jam = new Date();
                jam.setMilliseconds(jam.getMilliseconds() - jamD);
                h = (jam.getHours() < 10) ? "0" + jam.getHours() : jam.getHours();
                i = (jam.getMinutes() < 10) ? "0" + jam.getMinutes() : jam.getMinutes();
                s = (jam.getSeconds() < 10) ? "0" + jam.getSeconds() : jam.getSeconds();
                document.getElementById("jam").innerHTML = h + ":" + i + ":" + s;
            }
            var xa = setInterval("show()", 100);</script>

        <style>
            #topbar {
                color: #fde19a;
                background: #4f4a41;
                padding: 10px 0 10px 0;
                text-align: center;
                height: 36px;
                overflow: hidden;
                -webkit-transition: height 0.5s linear;
                -moz-transition: height 0.5s linear;
                transition: height 0.5s linear;
            }
            #topbar a {
                color: #fff;
                font-size:1.3em;
                line-height: 1.25em;
                text-decoration: none;
                opacity: 0.5;
                font-weight: bold;
            }
            #topbar a:hover {
                opacity: 1;
            }

            #tophiddenbar {
                display: block;
                width: 100%;
                background: #4f4a41;
                color: #b09f82;
                font-weight: bold;
                padding: 8px 0; 
                font-size: 1.0em;
                text-align: center;
                text-shadow: 1px 1px 0 #444;
            }
            #tophiddenbar a {
                color: #fff;
                font-size: 1.0em;
                text-decoration: none;
                opacity: 0.5;
                text-shadow: none;
            }
            #tophiddenbar a:hover { opacity: 1; }

            #topbar:hover { height: 90px; }
        </style>

    </head>
    <body>
        <!-- <body> -->
        <div id="wrapper">
            <div id="topbar">
                <div>&nbsp;
                    <script language="JavaScript" type="text/javascript">document.write(TODAY);</script>
                    &nbsp;<span id="jam"></span>&nbsp;
                </div>
                <div id="tophiddenbar">
                    <header id="page-header">
                        <div id="page-subheader">
                            <div class="wrapper clearfix" style="padding-left: 0px; left: 190px;">
                                <a class="navbar-brand" href="<?= base_url(); ?>"><?= APPNAME; ?></a>
                                <nav id="sub-nav"><?= menu($menu_list); ?></nav>
                            </div>
                        </div>
                    </header>
                </div>
            </div>
            <section id="content">
                <div id="" style="overflow:auto; padding: 10px 10px 10px 10px;">
                    <div class="container">
                        <div class="row">
                            <?= $contents ?>
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
                <div class="clear">&nbsp;</div>
            </section>
            <div class="clear"></div>
        </div>

        <footer id="page-footer"> 
            <div id="footer-inner">
                <p class="wrapper">
                    <span style="float: right;"><?= APPFOOTER; ?>  | 
                        <a href="https://www.facebook.com/mitratik" target="_blank">Follow me</a>
                    </span>
                    .:Rendered in <strong>{elapsed_time}</strong> seconds
                </p>
            </div>
        </footer>
    </body>
</html>

