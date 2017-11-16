
<?php

class Connection extends PDO {

    private $stmt;

    public function __construct($dsn, $username, $passwd) {
            parent::__construct($dsn, $username, $passwd);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Execute a quary on database
     * @param type $query
     * @param array $parameters
     * @return type
     */
    public function executeQuery($query, array $parameters = []) {
            $this->stmt = parent::prepare($query);

            foreach ($parameters as $name => $value) {

                $this->stmt->bindValue($name, $value[0], $value[1]);
            }
            return $this->stmt->execute();
    }

    public function getResults() {
            return $this->stmt->fetchAll();
    }

    public function getNbResults() {
            return $this->stmt->rowCount();
    }
}

?>
