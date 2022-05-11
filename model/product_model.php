<?php

include_once '../commons/dbconnection.php';
$dbconnection= new dbConnection();

class Product{
    
    public function getAllUnits()
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM unit";
        $result=$conn->query($sql);
        return $result;
    }

    
    public function validateExistingBarcode($barcode)
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT 1 FROM product WHERE barcode_number='$barcode'";
        $result=$conn->query($sql);
        if($result->num_rows>0)//  when barcode is already there
        {
            return false;
        }
        else
        {   
                // when barcode is not available
            return true;
        }
        
    }

    public function addProduct($prname,$barcode,$cat_id,$brand_id,$unit_id,$price,$product_image)
    {
        $conn= $GLOBALS["conn"];
        $sql="INSERT INTO product(product_name,unit_id,cat_id,brand_id,product_price,barcode_number,product_image)VALUES"
                . "('$prname','$unit_id','$cat_id','$brand_id','$price','$barcode','$product_image')";
        $result=$conn->query($sql) or die($conn->error);
        return $result;
        return $conn->insert_id;
    }

  
     
    public function getAllProducts()
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM product p, category c, brand b,unit u WHERE p.cat_id=c.cat_id  AND p.brand_id=b.brand_id AND p.unit_id=u.unit_id";
        $result=$conn->query($sql) or die($conn->error);
        return $result;
    }
    
    public function getSpecificProduct($product_id)
    {
        $conn= $GLOBALS["conn"];
        $sql="SELECT * FROM product p, category c, brand b, unit u WHERE p.cat_id=c.cat_id "
                . " AND p.brand_id=b.brand_id AND p.unit_id=u.unit_id AND p.product_id='$product_id'";
        $result=$conn->query($sql) or die($conn->error);
        return $result;
    }
    
 
    
    
    
}




