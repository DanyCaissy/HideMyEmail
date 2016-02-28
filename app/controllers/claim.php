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

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if ($_POST['email'])
        {
            $emailAddress = trim(strtolower($_POST['email']));

            $email = $emailModel->getEmailFromAddress($emailAddress);

            if ($email)
            {
                require_once "../app/lib/recaptcha/autoload.php";

                $recaptcha = new \ReCaptcha\ReCaptcha("6LcFghkTAAAAAJNH7BpXti8yAOFuld3kf8e9qIoQ");
                $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

                if ($resp->isSuccess())
                {
                    $claimModel->add($email['id'], $data['sessionId']);

                    $emailURL = $_SERVER['SERVER_NAME']  . "/e/" . $email['alias'];
                    $manageURL = $manageURL = $_SERVER['SERVER_NAME'] . "/manage/" . $email['admin_hash'];

                    $message = "Someone claimed access to the following link: $emailURL" . "\r\n";
                    $message .= "This is the URL you need to access to modify your link: $manageURL" . "\r\n" . "\r\n";
                    $message .= "If you were not the person requesting this claim, please reply to this email.";

                    plainMail($email['address'], "Your claimed link's information", $message);

                    $successMessage = "You should receive an email from us shortly!";
                }
                else
                {
                    $errorMessage = "You have failed the captcha test, please try again!";
                }
            }
            else
            {
                $errorMessage = "The email you've entered doesn't exist in our database, try a different one.";
            }
        }
    }

    require_once "../app/views/header.php";

    require_once "../app/views/claim.php";

    require_once "../app/views/footer.php";
