<?php

///  include fpdf library

include '../commons/fpdf181/fpdf.php'; 
include '../model/user_model.php';
include '../model/stock_model.php';

$userObj = new User();
// $stockObj = new Stock();

$userResult= $userObj->getUserSalariesFunctionAll();

$fpdf= new FPDF('P','mm','A4');

$fpdf->SetTitle("Salary Report");  ///  set the title for the Document

$fpdf->AddPage("P", "A4",0);

$fpdf->SetFont("Arial","B",16);  /// Setting Fonts  

$fpdf->Cell(0,20,"VEHICLE REPAIRE MANEGEMENT SYSTEM",0,1,"C");

$fpdf->Cell(0,20,"Salary Report",0,1,"C");

$fpdf->Image("../images/iconset/name.png", 5,15, 40, 30);

$fpdf->SetFont("Arial","B",9);  /// Setting Fonts  

//  table heading
$fpdf->Cell(30,10,"Id",1,0,"C");
$fpdf->Cell(30,10,"Name",1,0,"C");
$fpdf->Cell(30,10,"user_id",1,0,"C");
$fpdf->Cell(40,10,"Pay_on",1,0,"C");
$fpdf->Cell(30,10,"Amount",1,1,"C");

$fpdf->SetFont("Arial","",9);  /// Setting Fonts  

date_default_timezone_set('Asia/Colombo');
// $date = new DateTime('NOW');
// echo $date->format('m-Y')."\n";
// $date->modify('-1 month');
// echo $date->format('Y-m-d h:i:sa');
// echo date('d-m-Y', $current_time);

// $comp = new DateInterval('PT' . 7 . 'H');
// $comp->add(new DateInterval('PT' . 480 . 'M'));



while($productrow=$userResult->fetch_assoc())
{
    // echo $counterDays. "\n";
    $totalDiff = new DateTime($productrow["payDate"]);
    // echo $totalDiff->format("Y-%m-%d %H %i %s"). "<br>" ;

    // $comp->diff(new DateTime('NOW'));
    // echo $totalLeaveDays. "<br>" ;
    echo "ccccccccccccccccccc<br>";
    // table body
    $fpdf->Cell(30,10,$productrow["id"],1,0,"C");
    $fpdf->Cell(30,10,$productrow["userId"],1,0,"C");
    $fpdf->Cell(30,10,$productrow["user_fname"]. " ". $productrow["user_lname"] ,1,0,"C");
    $fpdf->Cell(40,10,$totalDiff->format("(Y-m-d) H:i:s"),1,0,"R");
    $fpdf->Cell(30,10,$productrow["amount"],1,1,"R");
    // $fpdf->Cell(50,10,$tot_qty." ".$productrow["unit_name"],1,1,"R");
}
///  report body, report ,notes   (sequence and state transition diagrams)



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

?>


