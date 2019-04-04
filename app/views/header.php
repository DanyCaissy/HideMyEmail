<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php header('X-UA-Compatible: IE=edge,chrome=1'); ?>
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="msvalidate.01" content="7DA74ACC0FF75310579388A12DEFB4D5" />
        <link rel="canonical" href="<?php echo $data['canonical']; ?>" />
        <title><?php echo $data['title']; ?></title>

        <link href="/styles/general.css" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="/libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/libraries/bootstrap/css/bootstrap-theme-slate.css" rel="stylesheet">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <?php if (isset($noIndex) && $noIndex) : ?>
            <meta name="robots" content="noindex">
        <?php endif; ?>

        <meta name="description" content="<?php echo $data['meta_description']; ?>">

        <!-- ****** faviconit.com favicons ****** -->
        <link rel="shortcut icon" href="/images/favicon/favicon.ico">
        <link rel="icon" sizes="16x16 32x32 64x64" href="/images/favicon/favicon.ico">
        <link rel="icon" type="image/png" sizes="196x196" href="/images/favicon/favicon-196.png">
        <link rel="icon" type="image/png" sizes="160x160" href="/images/favicon/favicon-160.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96.png">
        <link rel="icon" type="image/png" sizes="64x64" href="/images/favicon/favicon-64.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/favicon-152.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/favicon-144.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/favicon-120.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/favicon-114.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/favicon-76.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/favicon-72.png">
        <link rel="apple-touch-icon" href="favicon-57.png">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="/images/favicon/favicon-144.png">
        <meta name="msapplication-config" content="/browserconfig.xml">
        <!-- ****** faviconit.com favicons ****** -->

        <!-- Nibbler -->
        <meta name="nibbler-site-verification" content="a340aec259677f4215f1f1859988d6772fe67213" />

        <meta name="google-site-verification" content="brpSUFUNstJGB--f1P8TA21BPCcHDWvISg8nnGPCtpU" />

        <!-- Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-51263844-1', 'hidemyemail.co');
            ga('require', 'displayfeatures');
            ga('send', 'pageview');

        </script>

        <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>
    <body class="<?php echo $data['background']; ?>" style="background-color:black;">

        <div class="navbar navbar-default navbar-fixed-top" style="margin-bottom:300px;">
            <div class="container">
                <div class="navbar-header">
                    <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>" class="navbar-brand">Hide my email</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">

                    <?php /*

                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']  . "/claim/"; ?>">Reclaim</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']  . "/contact/"; ?>">Contact us</a>
                        </li>
                    </ul> */ ?>

                </div>
            </div>
        </div>











