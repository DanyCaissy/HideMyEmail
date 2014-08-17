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

    require_once "../app/views/header.php";

    if ($email['disabled'])
    {
        require_once "../app/views/disabled.php";
    }
    else if ($email['captcha'])
    {
        require_once "../app/lib/playthru/ayah.php";

        $ayah = new AYAH();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $score = $ayah->scoreResult();

            if ($score)
            {
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
