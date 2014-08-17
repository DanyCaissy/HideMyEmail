<?php

    // Generates aliases
    class Settings
    {
        private $dataConnection;

        function __construct($dataConnection)
        {
            $this->dataConnection = $dataConnection;
        }

        public function initialize()
        {
            $query = "SELECT id
                      FROM settings";

            $settings = $this->dataConnection->query($query, true);

            if (!$settings)
            {
                $query = "INSERT INTO settings
                          SET alias_length = 3";
                return $this->dataConnection->run($query);
            }
        }

    }