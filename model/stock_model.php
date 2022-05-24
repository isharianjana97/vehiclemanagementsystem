<?php

include_once '../commons/dbconnection.php';
$dbconnection = new dbConnection();

class Stock
{

    public function addStock($product_id, $quantity, $stock_date)
    {
        $conn = $GLOBALS["conn"];
        $sql = "INSERT INTO stock(product_id,quantity,stock_date)VALUES('$product_id','$quantity','$stock_date')";
        $result = $conn->query($sql);
        return $result;
    }

    public function getProductStock($product_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT SUM(quantity) as tot_qty FROM stock WHERE product_id='$product_id' GROUP BY product_id"; //for the summation of given product id
        $result = $conn->query($sql);

        $stockrow = $result->fetch_assoc();

        $qty = $stockrow["tot_qty"];

        return $qty;
    }
}
