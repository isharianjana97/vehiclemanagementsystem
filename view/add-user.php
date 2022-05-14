<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray= $_SESSION["user_module"];

include_once '../model/user_model.php';
$userObj=new User();
$roleResult=$userObj->getUserRoles();

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
                        <h4 align="center"> Add User </h4>
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
                    <?php
                                        include_once '../includes/user-navigation.php';
                    ?>
                </div>

                    <div class="col-md-9">
                        <form action="../controller/user_controller.php?status=add_user " enctype="multipart/form-data" method="post">
                            
                            
                            
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3" id="alertdiv">&nbsp;</div>  <!-- Display alert message-->
                            </div> 
                            
                            
                            <!-- to display alert messages -->
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
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            
                        <div class="row">                <!--   Enter first name and the last name -->
                            <div class="col-md-2">
                                <label class="control-label"> First Name </label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="fname" id="fname" class="form-control"/>
                            </div>
                            
                            <div class="col-md-2">
                                <label class="control-label"> Last Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="lname" id="lname" class="form-control"/>
                            </div>
                        </div>                            <!--   Enter first name and the last name -->
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label"> Email</label>  <!--   Enter Email  -->
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="email" id="email" class="form-control"/>
                            </div>
                            
                            <div class="col-md-2">
                                <label class="control-label"> NIC</label>   <!--   Enter NIc  -->
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="nic" id="nic" class="form-control"/>
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
                                Male &nbsp;<input type="radio" name="gender" value="0" checked="checked"/>   <!--   Enter Gender -->
                                Female &nbsp;<input type="radio" name="gender" value="1"/>
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
                                <input type="text" name="cno1" id="cno1" class="form-control"/> <!--   Enter CNO 1 -->
                            </div>
                            
                            <div class="col-md-2">
                                <label class="control-label"> Contact Mobile</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="cno2" id="cno2" class="form-control"/> <!--   Enter CNO 2 -->
                            </div>
                        </div>
                        
                        
                         <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-md-2">    <!--   Enter User Role -->
                                <label class="control-label"> User Role</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="user_role" name="user_role">
                                <option value=""> ------</option>
                                <?php
                                 while ($role_row =$roleResult->fetch_assoc())
                                {
                                ?>
                                <option value="<?php echo $role_row["role_id"]; ?>"><?php echo $role_row["role_name"]?></option>
                                <?php
                                }
                                  ?>
                                </select>
                            </div>                     <!--   Enter User Role -->
                            
                            <div class="col-md-2">      <!--   Enter User image -->
                                <label class="control-label"> User Image</label>
                            </div>
                            <div class="col-md-4">
                               
                              <input type="file" name="user_img" id="user_img" class="form-control" onchange="readImage(this);"/>
                                <br/>
                                <img id="imgprev"/>
                            </div>                      <!--   Enter User image -->
                            
                            
                            
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
                            
                        <div class="row">
                            <div class="col-md-6 col-md-offset-2">
                                <input type="submit" class="btn btn-success" value="save"/> &nbsp;  <!--   Enter Submit -->
                                <input type="reset" class="btn btn-danger" value="reset"/>         <!--   Enter Reset -->
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
    
    
    <script>    <!--   Read User image -->
            function readImage(input)
            {
                ///  check if I have selected a file
                if(input.files  && input.files[0])
                {
                    var reader = new FileReader();   <!--   open file reader -->
                    reader.onload= function(e)       <!--   onload - uploaded file -->
                    {
                        $("#imgprev")
                                .attr('src',e.target.result) 
                                .width(70)
                                .height(80)
                    };
                    
                    reader.readAsDataURL(input.files[0]) 
                    
                    
                }
                
                
            }
    
    
    </script>  <!--   Read User image -->

</html> 


