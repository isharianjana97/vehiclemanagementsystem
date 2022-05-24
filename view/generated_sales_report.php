<?php

///  include fpdf library

include '../commons/fpdf181/fpdf.php'; 
include '../model/customer_model.php';
include '../model/vehicle_model.php';

$userObj = new Vehicle();

$userResult= $userObj->getVehicleAll();

$fpdf= new FPDF('P','mm','A4');

$fpdf->SetTitle("Vehicle Repot");  ///  set the title for the Document

$fpdf->AddPage("P", "A4",0);

$fpdf->SetFont("Arial","B",16);  /// Setting Fonts  

$fpdf->Cell(0,20,"VEHICLE REPAIRE MANEGEMENT SYSTEM",0,1,"C");

$fpdf->Cell(0,20,"Vehicle Report",0,1,"C");

$fpdf->Image("../images/iconset/name.png", 5,15, 40, 30);

$fpdf->SetFont("Arial","B",7);  /// Setting Fonts  

//  table heading
$fpdf->Cell(15,10,"Vehicle Id",1,0,"C");
$fpdf->Cell(20,10,"Vehicle name",1,0,"C");
$fpdf->Cell(30,10,"Vehicle Issue",1,0,"C");
$fpdf->Cell(25,10,"Customer name",1,0,"C");
$fpdf->Cell(20,10,"Arrived on",1,0,"C");
$fpdf->Cell(20,10,"Delivered on",1,0,"C");
$fpdf->Cell(10,10,"Charge",1,0,"C");
$fpdf->Cell(30,10,"Status",1,1,"C");

$fpdf->SetFont("Arial","",4);  /// Setting Fonts  

echo "<br>";

while($customerrow=$userResult->fetch_assoc())
{
    // table body
    $fpdf->Cell(15,10,$customerrow["vehicle_id"],1,0,"C");
    $fpdf->Cell(20,10,$customerrow["vehicle_name"] ,1,0,"C");
    $fpdf->Cell(30,10,$customerrow["vehicle_issue"] ,1,0,"C");
    $fpdf->Cell(25,10,$customerrow["customer_name"] ,1,0,"C");
    $fpdf->Cell(20,10,$customerrow["arrived_on"] ,1,0,"C");
    $fpdf->Cell(20,10,$customerrow["delivered_on"] ,1,0,"C");
    $fpdf->Cell(10,10,$customerrow["task_charge"] ,1,0,"C");
    $fpdf->Cell(30,10,$customerrow["status"] ,1,1,"C");

}

$fpdf->SetFont("Arial","",5);  /// Setting Fonts  
$fpdf->Cell(200,10,"This is a computer generated document and requires no aurgorized signature",0,1,"L");
$date=date("Y-m-d H:i:s");
$fpdf->Cell(200,10,"Generated on: $date",0,1,"L");

if($_REQUEST["status"] == 'save')
{

    $fpdf->Output('I',"docf.pdf");  //  display the pdf on the browser
}
else{
    $d1="User_report_".$date;
    $filename=$d1.".pdf";
    $path="../documents/stock_report/$filename";
    $fpdf->Output($filename,"D");  /// download the file
   
   // $fpdf->Output($path,'F');
    
}
