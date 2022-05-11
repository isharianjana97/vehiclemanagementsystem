<?php

include_once '../commons/dbconnection.php';
$dbconnection= new dbConnection();

class Purchasing{
    
    public function addNote($reqdate)
    {
        $conn= $GLOBALS["conn"];
        $sql="INSERT INTO tempory_note(requistion_date)VALUES('$reqdate')";
        $result=$conn->query($sql);
        $note_id=$conn->insert_id;
        return $note_id;
    }
    
    public function addLocation($locationName,$latitude,$longitude)
    {
        $conn= $GLOBALS["conn"];
        $sql="INSERT INTO location(location_name,latitude,longitude)VALUES"
                . "('$locationName','$latitude','$longitude')";
        $result=$conn->query($sql) or die($conn->error);
    }
    
    
    public function getAlllocations()
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM location";
        $result=$conn->query($sql);
        return $result;
    }
    
 
    
    
    
}