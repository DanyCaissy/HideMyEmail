<?php

    // Generates aliases
    class Aliases
    {
        private $dataConnection;

        function __construct($dataConnection)
        {
            $this->dataConnection = $dataConnection;
        }

        public function isAliasAvailable($alias)
        {
            $alias = $this->dataConnection->escape($alias);

            $query = "SELECT
                            (SELECT COUNT(*) FROM restricted_aliases WHERE alias = '$alias') AS restricted_count,
                            (SELECT COUNT(*) FROM emails WHERE alias = '$alias') AS alias_count";

            $aliasCount = $this->dataConnection->query($query, 1);

            if ($aliasCount['restricted_count'] || $aliasCount['alias_count'])
            {
                return false;
            }
            else
            {
                return true;
            }
        }

        private function getAliasLength()
        {
            $query = "SELECT alias_length
                      FROM settings";

            $settings = $this->dataConnection->query($query, true);

            return $settings['alias_length'];
        }

        private function incrementAliasLength($aliasLength)
        {
            $query = "UPDATE settings
                      SET alias_length = ?";

            $params[] = array("name" => "alias_length", "type" => "i", "value" => $aliasLength);

            return $this->dataConnection->run($query); // Prepare query
        }

        /**
         * @return string
         */
        public function generateAlias()
        {
            $aliasLength = $this->getAliasLength();
            $attempts = 0;

            $finalAlias = substr(md5(rand() + time()), 0, $aliasLength);
            while (!$this->isAliasAvailable($finalAlias))
            {
                if ($attempts > 5)
                {
                    $aliasLength++;
                    $this->incrementAliasLength($aliasLength);
                }

                $finalAlias = substr(md5(rand() + time()), 0, $aliasLength);
                $attempts++;
            }

            return $finalAlias;
        }
    }