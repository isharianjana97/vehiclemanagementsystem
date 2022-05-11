<?php

///  include fpdf library

include '../commons/fpdf181/fpdf.php'; 
include '../model/product_model.php';
include '../model/stock_model.php';

$productObj = new Product();
$stockObj = new Stock();


$productResult= $productObj->getAllProducts();

$fpdf= new FPDF();
$fpdf->SetTitle("Stock Repot");  ///  set the title for the Document

$fpdf->AddPage("P", "A4",0);

$fpdf->SetFont("Arial","B",16);  /// Setting Fonts  

$fpdf->Cell(0,20,"ABC GROCERY MANEGEMENT SYSTEM",0,1,"C");

$fpdf->Cell(0,20,"Stock Repot",0,1,"C");

$fpdf->Image("../images/iconset/barcelona.png", 5,15, 20, 20);

$fpdf->SetFont("Arial","B",9);  /// Setting Fonts  

//  table heading
$fpdf->Cell(30,10,"Name",1,0,"C");
$fpdf->Cell(30,10,"Brand",1,0,"C");
$fpdf->Cell(30,10,"Category",1,0,"C");
$fpdf->Cell(30,10,"Price",1,0,"C");
$fpdf->Cell(50,10,"Total Stock Available",1,1,"C");

$fpdf->SetFont("Arial","",9);  /// Setting Fonts  

while($productrow=$productResult->fetch_assoc())
{
    $product_id=$productrow["product_id"];
    
     $tot_qty=  $stockObj->getProductStock($product_id);
    
// table body
$fpdf->Cell(30,10,$productrow["product_name"],1,0,"C");
$fpdf->Cell(30,10,$productrow["brand_name"],1,0,"C");
$fpdf->Cell(30,10,$productrow["cat_name"],1,0,"C");
$fpdf->Cell(30,10,"Rs ".$productrow["product_price"],1,0,"R");
$fpdf->Cell(50,10,$tot_qty." ".$productrow["unit_name"],1,1,"R");
}
///  report body, report ,notes   (sequence and state transition diagrams)


$fpdf->SetFont("Arial","",8);  /// Setting Fonts  
$fpdf->Cell(200,10,"This is a computer generated document and requires no aurgorized signature",0,1,"L");
$date=date("Y-m-d H:i:s");
$fpdf->Cell(200,10,"Generated on: $date",0,1,"L");


if(!isset($_REQUEST["status"]))
{

    $fpdf->Output();  //  display the pdf on the browser
}
else{
    $d1="User_report_".$date;
    $filename=$d1.".pdf";
    $path="../documents/stock_report/$filename";
    $fpdf->Output($filename,"D");  /// download the file
    
   
   // $fpdf->Output($path,'F');
    
}

?>


