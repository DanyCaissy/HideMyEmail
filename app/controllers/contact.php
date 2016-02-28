<?php

    require_once "../app/models/emails.php";
    require_once "../app/models/claims.php";

    $emailModel = new Emails($data['dataConnection']);
    $claimModel = new Claims($data['dataConnection']);

    $emailAddress = null;
    if (isset($data['alias']) && $data['alias'])
    {
        $email = $emailModel->getEmailFromAlias($data['alias']);
        $emailAddress = $email['address'];
    }

    $emailAddress = null;
    $message = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if ($_POST['email_address'])
        {
            $emailAddress = trim(strtolower($_POST['email_address']));
            $message = $_POST['message'];

            if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
            {
                if ($message)
                {
                    require_once "../app/lib/recaptcha/autoload.php";

                    $recaptcha = new \ReCaptcha\ReCaptcha("6LcFghkTAAAAAJNH7BpXti8yAOFuld3kf8e9qIoQ");
                    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

                    if ($resp->isSuccess())
                    {
                        plainMail("danycaissy@gmail.com", "You've received an email from $emailAddress", $message, $emailAddress);
                        $successMessage = "We've received your email and you should hear from us soon!";
                    }
                    else
                    {
                        $error = "You have failed the captcha test, please try again!";
                    }
                }
                else
                {
                    $error = "You need to provide a message!";
                }
            }
            else
            {
                $error = "The email address you've provided is invalid";
            }
        }
    }

    require_once "../app/views/header.php";

    require_once "../app/views/contact.php";

    require_once "../app/views/footer.php";
