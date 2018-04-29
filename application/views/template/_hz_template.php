<?php
//date_default_timezone_set("Singapore");
?>
<html lang="en">
    <head>
        <title><?= APPNAME; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" media="screen" href="<?= base_url() ?>files/style.css">
        <link rel="stylesheet" media="screen" href="<?= base_url() ?>files/bootstrap.css">

        <script src="<?= base_url() ?>files/jquery.min.js"></script>
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
            var xa = setInterval("show()", 100);
        </script>
        <script type="text/javascript" language="javascript">
            function newAlert(message) {
                $("#alert-area").append($("<div id='subalert' class='alert alert-success'><p> " + message + " </p></div>"));
                $("#alert-area").fadeTo(2000, 500).slideUp(500, function () {
                    $("#alert-area").slideUp(500);
                    $('#subalert').remove();
                });

            }
        </script>



    </head>
    <body>
        <!-- <body> -->
        <div id="wrapper">
            <div>&nbsp;
                <script language="JavaScript" type="text/javascript">document.write(TODAY);</script>
                &nbsp;<span id="jam"></span>&nbsp;
            </div>
            <header id="page-header">
                <div id="page-subheader">
                    <div class="wrapper clearfix" style="padding-left: 0px; left: 190px;">
                        <a class="navbar-brand" href="<?= base_url(); ?>"><?= APPNAME; ?></a>
                        <nav id="sub-nav"><?= menu($menu_list); ?></nav>
                    </div>
                </div>
            </header>
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
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
