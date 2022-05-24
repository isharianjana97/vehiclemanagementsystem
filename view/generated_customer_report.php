<?php

///  include fpdf library

include '../commons/fpdf181/fpdf.php'; 
include '../model/customer_model.php';
include '../model/stock_model.php';

$userObj = new Customer();

$userResult= $userObj->getAllCustomers();

$fpdf= new FPDF('P','mm','A4');

$fpdf->SetTitle("Attendance Repot");  ///  set the title for the Document

$fpdf->AddPage("P", "A4",0);

$fpdf->SetFont("Arial","B",16);  /// Setting Fonts  

$fpdf->Cell(0,20,"VEHICLE REPAIRE MANEGEMENT SYSTEM",0,1,"C");

$fpdf->Cell(0,20,"Customer Report",0,1,"C");

$fpdf->Image("../images/iconset/name.png", 5,15, 40, 30);

$fpdf->SetFont("Arial","B",9);  /// Setting Fonts  

//  table heading
$fpdf->Cell(30,10,"customer Id",1,0,"C");
$fpdf->Cell(30,10,"first name",1,0,"C");
$fpdf->Cell(30,10,"last name",1,0,"C");
$fpdf->Cell(30,10,"email",1,0,"C");
$fpdf->Cell(30,10,"contact number",1,1,"C");

$fpdf->SetFont("Arial","",9);  /// Setting Fonts  

echo "<br>";

while($customerrow=$userResult->fetch_assoc())
{
    // table body
    $fpdf->Cell(30,10,$customerrow["customer_id"],1,0,"C");
    $fpdf->Cell(30,10,$customerrow["customer_fname"] ,1,0,"C");
    $fpdf->Cell(30,10,$customerrow["customer_lname"] ,1,0,"C");
    $fpdf->Cell(30,10,$customerrow["customer_email"] ,1,0,"C");
    $fpdf->Cell(30,10,$customerrow["customer_contact"] ,1,1,"C");

}

$fpdf->SetFont("Arial","",8);  /// Setting Fonts  
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
