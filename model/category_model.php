<?php

include_once '../commons/dbconnection.php';
$dbconnection= new dbConnection();

class Category{
    
    public function  getAllCategories()
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM category";   
        $result=$conn->query($sql);
        return $result;
    }
    
    public function getSpecificCategory($cat_id)
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM category WHERE cat_id='$cat_id'";
        $result=$conn->query($sql);
        return $result;
    }

    
    
    public function addCategory($catName)
    {
        $conn= $GLOBALS["conn"];
        $sql="INSERT INTO category(cat_name)VALUES('$catName')";
        $result=$conn->query($sql);
        if($conn->insert_id>0)
        {
            return $conn->insert_id;
        }
        else{
            return 0;
        }
        
        
    }
     public function updateCategory($cat_id,$cat_name)
    {
         $conn= $GLOBALS["conn"];
        $sql="UPDATE category SET cat_name='$cat_name' WHERE cat_id='$cat_id'";
        $result=$conn->query($sql);
        
    }
    







}