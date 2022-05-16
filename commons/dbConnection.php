<?php

class dbConnection
{

    public $conn;
    private $dbhostname = "127.0.0.1";
    private $dbusername = "root";
    private $dbpassword = "Shehan@53645";
    private $dbname = "vehicle_management_db";

    public function __construct()
    {
        ///  create the db connection

        try {
            $this->conn = new mysqli($this->dbhostname, $this->dbusername,$this->dbpassword,$this->dbname);
            echo "Connection Successful";

            ///  checking if the db connection is succesful
            if (!$this->conn->connect_error) {
                echo "Connection Successful";
                $GLOBALS["conn"] =  $this->conn;
            } else {
                echo "Connection Error";
            }

        } catch (Exception $ex) {

            echo "DB doesnt exist" , $ex;

        }

    }
}
