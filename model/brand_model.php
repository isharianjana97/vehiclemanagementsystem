<?php
    include_once '../commons/dbconnection.php';
    $dbconnection= new dbConnection();
    
class Brand
{
    public function getAllBrands()
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM brand";
        $result=$conn->query($sql);
        return $result;
    }
    
    public function getSpecificBrand($brand_id)
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM brand WHERE brand_id='$brand_id'";
        $result=$conn->query($sql);
        return $result;
    }

    
    
     public function addBrand($brandName)
    {
        $conn= $GLOBALS["conn"];
        $sql="INSERT INTO brand(brand_name)VALUES('$brandName')";
        $result=$conn->query($sql);
        if($conn->insert_id>0)
        {
            return $conn->insert_id;
        }
        else{
            return 0;
        }
        
        
        
    }
    
    public function updateBrand($brand_id,$brand_name)
    {
        $brand_id;
        $conn= $GLOBALS["conn"];
        $sql="UPDATE brand SET brand_name='$brand_name' WHERE brand_id='$brand_id'";
        $result=$conn->query($sql);
    }


    
}