<?php

    class Claims
    {
        private $dataConnection;

        function __construct($dataConnection)
        {
            $this->dataConnection = $dataConnection;
        }

        public function add($emailId, $sessionId)
        {
            $query = "INSERT INTO claims (email_id, session_id)
                                  VALUES (?, ?)";

            // Prepare parameters to bind to the query, they must be in the same order as the query
            $params[] = array("name" => "email_id", "type" => "i", "value" => $emailId);
            $params[] = array("name" => "session_id", "type" => "i", "value" => $sessionId);

            return $this->dataConnection->run($query, $params); // Prepare query
        }

    }