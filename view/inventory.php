<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray= $_SESSION["user_module"];

?>
<html>
    <head>
        <!--  include bootstrap css   -->
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
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
                    <div class="col-md-2"><span class="glyphicon glyphicon-user"></span>
                    
                    &nbsp;
                    <?php
                    echo ucwords($_SESSION["user"]["user_fname"]." ".$_SESSION["user"]["user_lname"]);
                    ?>
                    </div>
                    <div class="col-md-8">
                        <h4 align="center"> Inventory Management </h4>
                    </div>
                    <div class="col-md-2">
                        <span class="glyphicon glyphicon-bell"></span>
                        &nbsp;
                        <button class="btn btn-primary"> Logout</button>
                    </div>
                    </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li> Dashboard</li>
                        </ul>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                          <?php include_once '../includes/main-inventory-navigation.php';?>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-6">
                            <div class="panel panel-default" style="background-color: #e67949; color: #FFF; height: 200px">
                                <h2 align="center"> Category Count 1 </h2>
                                <h1 align="center">7</h1>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default" style="background-color: #e67949; color: #FFF; height: 200px">
                                <h2 align="center"> Category Count 2 </h2>
                                <h1 align="center">12</h1>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default" style="background-color: #e67949; color: #FFF; height: 200px">
                                <h2 align="center"> Category Count 3 </h2>
                                <h1 align="center">13</h1>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default" style="background-color: #875139; color: #FFF; height: 200px">
                                <h2 align="center"> Sales Information </h2>
                                <h1 align="center">8</h1>
                            </div> 
                        </div>
                    </div>
                </div>
        </div>
   </body>
        <!--   include jquery -->
    <script src="../js/jquery-1.12.4.js"></script> 
  
    <script src="../js/loginvalidation.js"></script>
    <!-- include bootstrap js -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</html> 


