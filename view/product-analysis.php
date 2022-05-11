<?php
    include '../commons/sessions.php';
    
    ///  getting product module information
    include '../model/product_model.php';
    include '../model/stock_model.php';
    $productObj= new Product();
    $stockObj = new Stock();
    //   getting all users
    
    $productResult = $productObj->getAllProducts();
    
    
    $moduleArray= $_SESSION["user_module"];
?>
<html>
    <head>
        <!--  include bootstrap css   -->
                <!--  include bootstrap css   -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!--   include jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- include bootstrap js -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <!--   Google  Charts  -->
        <!--  Include library-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawStockReport);
            
            //   Create a javascript function for each chart we create  
            
            function drawStockReport(){
                
                ///  the data to be presented in chart form
                var data=google.visualization.arrayToDataTable([
                    ["product Name","Stock",{role:'style'}],// Header Row (Define Axises)  
                    
                   <?php
                        $colourArray=array("#8f32a8","#a8324e","#259c90");
                        $colour=0;
                        while($prrow=$productResult->fetch_assoc())
                        {
                            $productname=$prrow["product_name"];
                            $product_id=$prrow["product_id"];
                            $tot_qty=  $stockObj->getProductStock($product_id);
                   ?>
                    ["<?php echo $productname  ?>",<?php echo $tot_qty ?>,"<?php echo $colourArray[$colour]  ?>"],  ///  individual rows
                    <?php
                            $colour++;
                        }
                    ?>
            
                           
                ]);
                
                var options={
                    width:600,
                    height:400,
                    legend: { position: 'bottom'}
                }
                
                var chart= new google.visualization.ColumnChart(document.getElementById("stockchart"));
                chart.draw(data, options);
                
                
            }
            
            
        </script>
        
        
           <script>
         
         loadStock = function(productid)
         {
           
            var url="../controller/product_controller.php?status=load_stock_modal";
     
            $.post(url,{product_id:productid},function(data){
         
                $("#stockcont").html(data);

             });
             
         }
        
       
   </script>  
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img src="../images/iconset/name.png" width="200px" height="100px"/> 
                </div>
                <div class="col-md-8">
                    <h1 align="center"> PM Automobile Management System </h1>
                </div>
                 <div class="col-md-2">&nbsp;</div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-2">
                    <span class="glyphicon glyphicon-user"></span>
                    &nbsp;
                    <?php
                       echo ucwords($_SESSION["user"]["user_fname"]." ".$_SESSION["user"]["user_lname"]) ;
                    ?>
                </div>
                <div class="col-md-8">
                    <h4 align="center">  Product Analysis </h4>
                </div>
                <div class="col-md-2">
                    <span class="glyphicon glyphicon-bell"></span>
                    &nbsp;
                    <button class="btn btn-primary">Logout</button>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>Dashboard</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?php
                                        include_once '../includes/main-product-navigation.php';
                    ?>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="generated_stock_report.php" class="btn btn-success">
                                <span class="glyphicon glyphicon-book"></span> &nbsp;
                                Generate Stock Report
                            </a>
                        </div>    
                        <div class="col-md-4">    
                            <a href="generated_stock_report.php?status=save" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-save"></span> &nbsp;
                                Save Stock Report
                            </a>
                        </div> 
                        <div class="col-md-4">    
                            <a href="../controller/product_controller.php?status=send_email" class="btn btn-success">
                                <span class="glyphicon glyphicon-envelope"></span> &nbsp;
                                Send As Email
                            </a>
                        </div>    
                  
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div id="stockchart">
                            
                        </div>
                    </div>
               
                </div>
                
            </div>
        </div>
           <div class="modal fade" id="modalStock" role="dialog">
    
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                      <form action="../controller/product_controller.php?status=add_stock" method="post">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button> 
                      <h4 class="modal-title"> <span class="glyphicon glyphicon-plus"></span>&nbsp; Add Stock  </h4>
                    </div>
                    <div class="modal-body">
                        <div id="stockcont">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >
                            <span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Save
                        </button>

                      &nbsp;
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                  </div>

                </div>
            </div>
    </body>
    <!--   include jquery -->

</html>