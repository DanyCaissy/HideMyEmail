<?php

    require_once "../app/models/emails.php";
    require_once "../app/models/aliases.php";
    require_once "../app/models/emails.php";

    $emailModel = new Emails($data['dataConnection']);
    $aliasModel = new Aliases($data['dataConnection']);
    $emailModel = new Emails($data['dataConnection']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if ($_POST['alias'])
        {
            $email = $emailModel->getEmailFromHash($data['admin_hash']);

            $alias = trim(strtolower($_POST['alias_value']));
            $encodedAlias = urlencode($alias);

            if ($email['alias'] != $encodedAlias) // Do nothing if the alias didn't change
            {
                if ($aliasModel->isAliasAvailable($encodedAlias)) // Alias is available
                {
                    $emailModel->updateAlias($data['admin_hash'], $encodedAlias);
                    $successMessage = "The alias was changed successfully!";
                }
                else
                {
                    $errorMessage = "The alias you've selected is already taken, please choose another one!";
                }
            }

        }
        else if ($_POST['email'])
        {
            $email = $emailModel->getEmailFromHash($data['admin_hash']);

            $emailURL = $_SERVER['SERVER_NAME']  . "/e/" . $email['alias'];
            $manageURL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

            $message = "Thank you for using hidemyemail.co!" . "\r\n" . "\r\n";
            $message .= "Save this email as you will need it to manage your new, safe email link." . "\r\n" . "\r\n";
            $message .= "This is your link: $emailURL" . "\r\n";
            $message .= "This is the URL you can use to modify your link: $manageURL" . "\r\n" . "\r\n";
            $message .= "Feel free to reply to this email if you have any questions!";

            plainMail($email['address'], "Your link information", $message);

            $successMessage = "You should receive an email from us shortly!";
        }
        else
        {
            $emailModel->updateOptions($data['admin_hash'], $_POST['captcha'], $_POST['disabled']);
            $successMessage = "Your settings were saved successfully!";
        }
    }

    $email = $emailModel->getEmailFromHash($data['admin_hash']);

    $fullEmailURL = "http://" . $_SERVER['SERVER_NAME']  . "/e/" . $email['alias'];
    $emailURL = $_SERVER['SERVER_NAME']  . "/e/" . $email['alias'];
    $shortEmailURL = "http://" . str_replace("www.", "", $emailURL);
    $manageURL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $shortManageURL = "http://" . str_replace("www.", "", $manageURL);

    if (!$email)
    {
        $data['app']->notFound();
    }

    $noIndex = true;

    require_once "../app/views/header.php";
    require_once "../app/views/manage.php";
    require_once "../app/views/footer.php";
