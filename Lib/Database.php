<?php
class Database {

    private $Host;
    private $User;
    private $Pwd;
    private $DB;


    function __construct()
    {
        $this->Host     = constant('HOST');
        $this->DB       = constant('DB');
        $this->User     = constant('USER');
        $this->Pwd = constant('PASSWORD');
    }

    function connect(){
        try {
            $StringConnection = "mysql:host=".$this->Host.";dbname=".$this->DB;
            $conn = new PDO($StringConnection, $this->User, $this->Pwd);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            die();
            }
    }
}
