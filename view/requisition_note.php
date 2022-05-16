<?php
    include '../commons/sessions.php';
    
    ///  getting user module information
    
    $moduleArray= $_SESSION["user_module"];
    
    include '../model/user_model.php';
    $userObj = new User();
    
    $activeResult= $userObj->getActiveUserCount();
    
    $activerow=$activeResult->fetch_assoc();
    
    ///  deactivated user count
    $deactiveResult= $userObj->getDeactiveUser();
    $deactiveCount=$deactiveResult->num_rows;
    
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
                    <img src="../images/iconset/barcelona.png" width="100px" height="100px"/>
                </div>
                <div class="col-md-8">
                    <h1 align="center">EL Grocery Management System</h1>
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
                    <h4 align="center">  Requisition Note</h4>
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
                                        include_once '../includes/purchasing_navigation.php';
                    ?>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="date" id="reqdate" class="form-control" name="note_date"/>
                        </div>
                        <div class="col-md-3">
                            <button id="addnotebtn" type="button" class="btn btn-primary">Add Note</button>
                        </div>
                       
                    </div>  
                    <div id="notedescription">
                          
                    </div>
                </div>
                
            </div>
        </div>
    </body>
    <!--   include jquery -->
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/purchasingvalidation.js"></script>
    <!-- include bootstrap js -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</html>