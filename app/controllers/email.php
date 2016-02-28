<?php

    require_once "../app/models/emails.php";

    $emailModel = new Emails($data['dataConnection']);

    $email = $emailModel->getEmailFromAlias($data['alias']);

    // If there's no email with that alias, or the email is disabled
    if (!$email)
    {
        $data['app']->notFound();
    }

    $emailURL = $_SERVER['SERVER_NAME']  . "/e/" . $email['alias'];

    $noIndex = true;
    $captchaSuccess = false;

    require_once "../app/views/header.php";

    if ($email['disabled'])
    {
        require_once "../app/views/disabled.php";
    }
    else if ($email['captcha'])
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            require_once "../app/lib/recaptcha/autoload.php";

            $recaptcha = new \ReCaptcha\ReCaptcha("6LcFghkTAAAAAJNH7BpXti8yAOFuld3kf8e9qIoQ");
            $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

            if ($resp->isSuccess())
            {
                $captchaSuccess = true;
                $emailModel->addView($email['id']);
                require_once "../app/views/email.php";
            }
            else
            {
                $captchaInvalid = true;
                require_once "../app/views/captcha.php";
            }
        }
        else
        {
            require_once "../app/views/captcha.php";
        }
    }
    else
    {
        $emailModel->addView($email['id']);
        require_once "../app/views/email.php";
    }

    require_once "../app/views/footer.php";
