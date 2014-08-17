<?php

    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Set the relevant timezone
    date_default_timezone_set('America/Montreal');

    // Start sessions
    session_cache_limiter(false);
    session_start();

    require_once '../app/vendor/autoload.php';
    require_once "../app/lib/base_helper.php";
    require_once "../app/drivers/mysqlimproved_driver.php";
    require_once "../app/models/sessions.php";
    require_once "../app/models/settings.php";
    require_once "../app/lib/mobiledetect/mobile_detect.php";

    $production = false;
    if (gethostname() == 'server1.websitehostserver.net')
    {
        $production = true;
    }

    if ($production && stringContains($_SERVER['SERVER_NAME'], "www."))
    {
        $host = str_replace('www.', '', $_SERVER['SERVER_NAME']);

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://{$host}{$_SERVER['REQUEST_URI']}");
        exit;
    }

    // ======================== Database connection ========================

    if ($production)
    {
        $connectionInfo = array(
            "host" => "127.0.0.1",
            "user" => "hidemyem_user",
            "password" => "MyPassword",
            "database" => "hidemyem_ail",
            "port" => null,
            "socket" => null
        );
    }
    else
    {
        $connectionInfo = array(
            "host" => "127.0.0.1",
            "user" => "user",
            "password" => "user",
            "database" => "hidemyemail",
            "port" => null,
            "socket" => null
        );
    }

    $dataConnection = new MysqlImproved_Driver();
    $dataConnection->connect($connectionInfo);

    $sessionModel = new Sessions();
    $sessionId = $sessionModel->saveSession($dataConnection);

    $settingsModel = new Settings($dataConnection);
    $settingsModel->initialize();

    $detect = new Mobile_Detect;
    $isMobile = $detect->isMobile();

    $canonicalURL = current(explode("?", $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI']));

    // ======================== Routing ========================

    $app = new \Slim\Slim(array(
        'cookies.encrypt' => true,
        'cookies.secret_key' => 'my_secret_key',
        'cookies.cipher' => MCRYPT_RIJNDAEL_256,
        'cookies.cipher_mode' => MCRYPT_MODE_CBC
    ));


    // Disable debugging on live server
    // $app->config('debug', false);

    $app->config(array(
        'templates.path' => '../app/controllers/',
    ));

    // Variable added to any type of view
    $app->view->setData('dataConnection', $dataConnection);
    $app->view->setData('sessionId', $sessionId);
    $app->view->setData('isMobile', $isMobile);

    $app->get('/', function () use ($app)
    {
        $app->render
        (
            'main.php', array('app' => $app, 'title' => 'Hide my email from spammers', 'ads' => false,
                                             'meta_description' => 'Protect your email address from spammers with our safe, minified URL.',
                                             'background' => 'homepage_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"])
        );
    });

    $app->post('/', function () use ($app)
    {
        $app->render
            (
                'main.php', array('app' => $app, 'title' => 'Hide my email from spammers', 'ads' => false,
                                                  'meta_description' => 'Protect your email address from spammers with our safe, minified URL.',
                                                  'background' => 'homepage_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"])
            );
    });

    $app->get('/manage/:adminhash', function ($adminHash) use ($app)
    {
        $app->render
            (
                'manage.php', array('app' => $app, 'title' => 'Manage my email', 'ads' => true,
                                                              'admin_hash' => $adminHash, 'meta_description' => 'Manage your customized URL.',
                                                              'background' => 'manage_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/manage')
            );
    });

    $app->post('/manage/:adminhash', function ($adminHash) use ($app)
    {
        $app->render
            (
                'manage.php', array('app' => $app, 'title' => 'Manage my email', 'admin_hash' => $adminHash, 'ads' => true,
                                                              'meta_description' => 'Manage your customized URL.',
                                                              'background' => 'manage_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/manage')
            );
    });

    $app->get('/e/:alias', function ($alias) use ($app)
    {
        $app->render
            (
                'email.php', array('app' => $app, 'title' => 'Hide my email from spam', 'alias' => $alias, 'ads' => true,
                                                             'meta_description' => 'View the email address.',
                                                             'background' => 'email_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/e')
            );
    });

    $app->post('/e/:alias', function ($alias) use ($app)
    {
        $app->render
            (
                'email.php', array('app' => $app, 'title' => 'Hide my email from spam', 'ads' => true,
                                                  'alias' => $alias, 'meta_description' => 'View the email address.',
                                                  'background' => 'email_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/e')
            );
    });

    $app->get('/claim/', function () use ($app)
    {
        $app->render
            (
                'claim.php', array('app' => $app, 'title' => 'Claim your link', 'ads' => true,
                                                  'meta_description' => 'Recover a lost email link by claiming it.',
                                                  'background' => 'reclaim_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/claim')
            );
    });

    $app->get('/claim/:alias', function ($alias) use ($app)
    {
        $app->render
            (
                'claim.php', array('app' => $app, 'title' => 'Claim your link', 'alias' => $alias, 'ads' => true,
                                                             'meta_description' => 'Recover a lost email link by claiming it.',
                                                             'background' => 'reclaim_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/claim')
            );
    });

    $app->post('/claim/:alias', function ($alias) use ($app)
    {
        $app->render
            (
                'claim.php', array('app' => $app, 'title' => 'Claim your link', 'alias' => $alias, 'ads' => true,
                                                  'meta_description' => 'Recover a lost email link by claiming it.',
                                                  'background' => 'reclaim_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/claim')
            );
    });

    $app->post('/claim/', function () use ($app)
    {
        $app->render
            (
                'claim.php', array('app' => $app, 'title' => 'Claim your link', 'ads' => true,
                                                   'meta_description' => 'Recover a lost email link by claiming it.',
                                                   'background' => 'reclaim_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/claim')
            );
    });

    $app->get('/contact/', function () use ($app)
    {
        $app->render
            (
                'contact.php', array('app' => $app, 'title' => 'Contact us', 'ads' => true,
                                                    'meta_description' => 'Contact us for any matter.',
                                                    'background' => 'contact_me_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/contact')
            );
    });

    $app->post('/contact/', function () use ($app)
    {
        $app->render
            (
                'contact.php', array('app' => $app, 'title' => 'Contact us', 'ads' => true,
                                                    'meta_description' => 'Contact us for any matter.',
                                                    'background' => 'contact_me_background', 'canonical' => 'http://' . $_SERVER["SERVER_NAME"] . '/contact')
            );
    });

    /*
    $app->notFound(function () use ($app) {
        $app->render('404.html');
    });*/

    $app->run();


