<?php

class Connection {
    private $schema;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    
    public function __construct () {}

    protected function connect ( $schema ) {
        $this->schema = $schema;
        $connection = NULL;
        try {
            $connection = new mysqli($this->host, $this->username, $this->password, $this->schema);
            if ($connection->connect_error) {
                throw new Exception("Unable to connect.");
            } else {
                return $connection;
            }
        }
        catch (Exception $e) {
            echo 'Database connection failed.';
            die();
        }
    }
};