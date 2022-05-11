<?php

include_once '../commons/dbconnection.php';
$dbconnection= new dbConnection();

class item{
    
    public function getAllitems()
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM item";
        $result=$conn->query($sql);
        return $result;
    }






}