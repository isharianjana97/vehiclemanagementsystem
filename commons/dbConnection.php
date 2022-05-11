<?php

class dbConnection{
    
    public $conn;
    private $dbhostname="localhost";
    private $dbusername="root";
    private $dbpassword="";
    private $dbname="vehicle_management_db";
    
    public function __construct() {
        ///  create the db connection
    $this->conn= new mysqli(
                $this->dbhostname,
                $this->dbusername,
                $this->dbpassword,
                $this->dbname
                );
    ///  checking if the db connection is succesful
    if(!$this->conn->connect_error)
    {
        $GLOBALS["conn"]=  $this->conn;
    }
    else{
        echo "Connection Error";
    }
    
        
        
    }
    
    
    
}
