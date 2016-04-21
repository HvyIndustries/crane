<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

class ConnectionDB
{

    private $dbhost = "localhost";
    private $dbuser = "user";
    private $dbpass = "pass";
    private $dbname = "dbname";
    /** @var PDO */
    public $conn;

    public function openDbConnection()
    {
        try
        {
            $this->dbhost;
            $this->conn = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname;", $this->dbuser, $this->dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'"));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function closeDbConnection()
    {
        try
        {
            $this->conn = NULL;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}