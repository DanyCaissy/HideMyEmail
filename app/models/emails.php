<?php

    // Generates aliases
    class Emails
    {
        private $dataConnection;

        function __construct($dataConnection)
        {
            $this->dataConnection = $dataConnection;
        }

        public function isHashAvailable($hash)
        {
            $hash = $this->dataConnection->escape($hash);

            $query = "SELECT COUNT(*) AS hash_count
                      FROM emails
                      WHERE admin_hash = '$hash'";

            $hashCount = $this->dataConnection->query($query, 1);

            if ($hashCount['hash_count'])
            {
                return false;
            }
            else
            {
                return true;
            }
        }

        private function getAdminHash()
        {
            $attempts = 0;

            $adminHash = substr(md5(rand() + time()), 0, 16);
            while (!$this->isHashAvailable($adminHash))
            {
                if ($attempts > 5)
                {
                    die('Error creating admin hash, please contact the administrator');
                }

                $adminHash = substr(md5(rand() + time()), 0, 16);
                $attempts++;
            }

            return $adminHash;
        }

        public function getEmailFromAddress($emailAddress)
        {
            $emailAddress = $this->dataConnection->escape($emailAddress);

            $query = "SELECT *
                      FROM emails
                      WHERE address = '$emailAddress'";

            return $this->dataConnection->query($query, 1);
        }

        public function getEmailFromAlias($alias)
        {
            $alias = $this->dataConnection->escape($alias);

            $query = "SELECT *
                      FROM emails
                      WHERE alias = '$alias'";

            return  $this->dataConnection->query($query, 1);
        }

        public function getEmailFromHash($adminHash)
        {
            $adminHash = $this->dataConnection->escape($adminHash);

            $query = "SELECT *
                      FROM emails
                      WHERE admin_hash = '$adminHash'";

            return $this->dataConnection->query($query, 1);
        }

        public function addView($emailId)
        {
            $ipAddress = ip2long($_SERVER['REMOTE_ADDR']);

            $query = "SELECT *
                      FROM visits_per_ip
                      WHERE email_id = $emailId
                      AND ip_address = $ipAddress";

            if (!$this->dataConnection->query($query))
            {
                // Insert into the table to prevent duplicate views
                $query = "INSERT INTO visits_per_ip
                          SET email_id = ?, ip_address = ?";

                $params = null;
                $params[] = array("name" => "email_id", "type" => "i", "value" => $emailId);
                $params[] = array("name" => "ip_address", "type" => "i", "value" => $ipAddress);

                $this->dataConnection->run($query, $params); // Prepare query

                // Update the count
                $query = "UPDATE emails
                          SET views = views + 1
                          WHERE id = ?";

                $params = null;
                $params[] = array("name" => "id", "type" => "i", "value" => $emailId);

                $this->dataConnection->run($query, $params); // Prepare query
            }
        }

        public function updateOptions($adminHash, $captcha, $disabled)
        {
            $query = "UPDATE emails
                      SET captcha = ?, disabled = ?
                      WHERE admin_hash = ?";

            $params[] = array("name" => "captcha", "type" => "i", "value" => $captcha);
            $params[] = array("name" => "disabled", "type" => "i", "value" => $disabled);
            $params[] = array("name" => "admin_hash", "type" => "s", "value" => $adminHash);

            return $this->dataConnection->run($query, $params); // Prepare query
        }

        public function updateAlias ($adminHash, $alias)
        {
            $query = "UPDATE emails
                      SET alias = ?
                      WHERE admin_hash = ?";

            $params[] = array("name" => "alias", "type" => "s", "value" => $alias);
            $params[] = array("name" => "admin_hash", "type" => "s", "value" => $adminHash);

            return $this->dataConnection->run($query, $params); // Prepare query
        }

        public function addEmail($email, $encodedAlias, $botProtection, $sessionId)
        {
            $adminHash = $this->getAdminHash();

            $query = "INSERT INTO emails (address, alias, admin_hash, captcha, session_id)
                                  VALUES (?, ?, ?, ?, ?)";

            $params[] = array("name" => "address", "type" => "s", "value" => $email);
            $params[] = array("name" => "alias", "type" => "s", "value" => $encodedAlias);
            $params[] = array("name" => "admin_hash", "type" => "s", "value" => $adminHash);
            $params[] = array("name" => "captcha", "type" => "i", "value" => $botProtection);
            $params[] = array("name" => "session_id", "type" => "i", "value" => $sessionId);

            $this->dataConnection->run($query, $params); // Prepare query

            return $adminHash;
        }

    }