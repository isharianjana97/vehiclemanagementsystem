<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray= $_SESSION["user_module"];

include_once '../model/user_model.php';
$userObj=new User();
$roleResult=$userObj->getUserRoles();


$user_id=$_GET["user_id"]; //get user id

$user_id= base64_decode($user_id); //decode the original value

$userResult= $userObj->getSpecificUser($user_id);

$userrow=$userResult->fetch_assoc(); // will convert the record onto associative array

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
                        <h4 align="center"> View User </h4>
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
                
               <!--  <div class="row">
                  <div class="col-md-12">
                       <ul class="breadcrumb">
                            <li> <a href="dashboard.php">Dashboard</a></li>
                            <li> <a href="user.php">User Management</a></li>
                            <li> View User</li> 
                        </ul>
                    </div> 
                </div>-->
                <div class="row">
                    <div class="col-md-3">
                    <?php
                                        include_once '../includes/user-navigation.php';
                    ?>
                </div>
                    <div class="col-md-9">
                        <form action="../controller/user_controller.php?status=add_user " enctype="multipart-form" method="post"> <!-- connection to add user page -->

                            
                           <div class="row">
                                <div class="col-md-6 col-md-offset-3" id="alertdiv">&nbsp;</div>
                            </div> 
                            <?php
                            if(isset($_GET["msg"]))
                            {
                                
                                $msg= base64_decode($_GET["msg"]);
                                ?>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">  
                                <div class="alert alert-danger">
                                    <?php 
                                        echo $msg;
                                    ?>
                                </div>    
                                  </div>
                            </div> 
                            
                                <?php
                            }
                            
                            
                            ?>
                            <div class="row">
                                <div class="col-md-9">&nbsp;</div>
                                <div class="col-md-3">
                                    <a a href="edit-user.php?user_id=<?php echo base64_encode($user_id); ?>" class="btn btn-warning">

                                        <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                                        Edit
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label"> First Name</label>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> <?php echo ucwords($userrow["user_fname"]);?></label>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label"> Last Name</label>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> <?php echo ucwords($userrow["user_lname"]);?></label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label"> Email</label>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> <?php echo ucwords($userrow["user_email"]);?></label>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label"> NIC</label>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> <?php echo ucwords($userrow["user_nic"]);?></label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp; 
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label"> Gender </label>
                            </div>
                            <div class="col-md-4">
                                <?php
                                if($userrow["user_gender"]==1)
                               {
                                  ?>
                                <label class ="badge"> Female</label>
                                <?php
                                }
                                else{
                                    ?>
                                <label class ="badge"> Male</label>
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label"> Contact Land</label>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> <?php echo ucwords($userrow["user_cno1"]);?></label>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label"> Contact Mobile</label>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> <?php echo ucwords($userrow["user_cno2"]);?></label>
                            </div>
                        </div>
                        
                         <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label"> User Role</label>
                            </div>
                            <div class="col-md-4">
                              <label class="control-label"> <?php echo ucwords($userrow["role_name"]);?></label>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label"> User Image</label>
                            </div>
                            <div class="col-md-4">
                               <?php
                               $userimage="";
                               if($userrow["user_image"]=="")
                               {
                                   $userimage="defaultImage.jpg";
                               }
                               else{
                                   $userimage=$userrow["user_image"];
                               }
                               ?>
                                <img src="../images/user_images/<?php echo $userimage;?>" width="100" height="120px"/>
                            </div>
                        </div>
                            
                            <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                            
                            <div class="row">
                                <div class="col-md-12" id="cont">
                           </div>
                        </div>
                            
                        
                        </form>
                        
                     
                    </div>
                    
                </div>
        </div>
   </body>
        <!--   include jquery -->
    <script src="../js/jquery-1.12.4.js"></script> 
  
    <script src="../js/uservalidation.js"></script>
    <!-- include bootstrap js -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
            function readImage(input)
            {
                ///  check if I have selected a file
                if(input.files  && input.files[0])
                {
                    var reader = new FileReader();
                    reader.onload= function(e)
                    {
                        $("#imgprev")
                                .attr('src',e.target.result)
                                .width(70)
                                .height(80)
                    };  
                    
                    reader.readAsDataURL(input.files[0])
                    
                    
                }
                
                
            }
    
    
    </script>

</html> 



