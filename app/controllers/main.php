<?php

    $email = null;
    $alias = null;
    $emailInvalid = false;
    $aliasInvalid = false;
    $botProtection = 1;

    if ($data['isMobile'])
    {
        $width = 80;
    }
    else
    {
        $width = 50;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $email = trim(strtolower($_POST['email']));
        $alias = trim(strtolower($_POST['alias']));
        $botProtection = isset($_POST['bot_protection']) ? 1 : 0;

        $encodedAlias = urlencode($alias);

        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            require_once "../app/models/aliases.php";
            require_once "../app/models/emails.php";

            $aliasModel = new Aliases($data['dataConnection']);
            $emailModel = new Emails($data['dataConnection']);

            if ($emailRecord = $emailModel->getEmailFromAddress($email))
            {
                $emailAlreadyExists = true;
            }
            else
            {
                // If the user defined their own alias
                if ($encodedAlias)
                {
                    if (!$aliasModel->isAliasAvailable($encodedAlias)) // Alias is not available
                    {
                        $aliasInvalid = true;
                    }
                    else
                    {
                        $adminHash = $emailModel->addEmail($email, $encodedAlias, $botProtection, $data['sessionId']);
                        header('Location: manage/' . $adminHash);
                        exit;
                    }
                }
                else // Create an automatic alias
                {
                    $encodedAlias = $aliasModel->generateAlias();

                    $adminHash = $emailModel->addEmail($email, $encodedAlias, $botProtection, $data['sessionId']);
                    header('Location: manage/' . $adminHash);
                    exit;
                }
            }
        }
        else
        {
            $emailInvalid = true;
        }
    }


    $emailInputError = null;
    if ($emailInvalid)
    {
        $emailInputError = "has-error";
    }

    $aliasInputError = null;
    if ($aliasInvalid)
    {
        $aliasInputError = "has-error";
    }

    require_once "../app/views/header.php";
    require_once "../app/views/main.php";
    require_once "../app/views/footer.php";


