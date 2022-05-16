<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray= $_SESSION["user_module"];

include_once '../model/user_model.php';
$userObj=new User();
$roleResult=$userObj->getUserRoles();

$user_id=$_REQUEST["user_id"];
$user_id=  base64_decode($user_id);

$userResult= $userObj->getSpecificUser($user_id);

$userrow=$userResult->fetch_assoc();


    ///  get user assigned functions
    
    $functionResult=$userObj->getUserAssignedFunctions($user_id);

    $userfunctionArray=array();
    while($functionRow=$functionResult->fetch_assoc())
    {
        array_push($userfunctionArray, $functionRow["function_id"]);
        
    }
 



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
                        <h4 align="center"> Edit User </h4>
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
                            <a href="add-user.php" class="list-group-item">
                                <span class="glyphicon glyphicon-search"></span>
                                &nbsp;
                                Add Users
                            </a>
                            <a href="view-user.php" class="list-group-item">
                                <span class="glyphicon glyphicon-search"></span>
                                &nbsp;
                                View Users
                            </a>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <form action="../controller/user_controller.php?status=update_user " enctype="multipart/form-data" method="post">
                            
                            
                            
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
                            
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/> <!-- telling the controller this is the user that we have selected-->
                            
                        <div class="row">                <!--   Enter first name and the last name -->
                            <div class="col-md-2">
                                <label class="control-label"> First Name </label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $userrow["user_fname"];?>"/>
  <!-- display something inside the text box we use value attribute-->
                            </div>
                            
                            <div class="col-md-2">
                                <label class="control-label"> Last Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $userrow["user_lname"];?>"/>
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
                                <input type="text" name="email" id="email" class="form-control" value="<?php echo $userrow["user_email"];?>"/>
                            </div>
                            
                            <div class="col-md-2">
                                <label class="control-label"> NIC</label>   <!--   Enter NIc  -->
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="nic" id="nic" class="form-control" value="<?php echo $userrow["user_nic"];?>"/>
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
                                Male &nbsp;<input type="radio" name="gender" value="0" 
                                                  <?php if($userrow["user_gender"]==0){ ?>
                                                  checked="checked"
                                                  <?php
                                                  }
                                                  ?>
                                                  />   <!--   Enter Gender -->
                                Female &nbsp;<input type="radio" name="gender" value="1"
                                                     <?php if($userrow["user_gender"]==1){ ?>
                                                  checked="checked"
                                                  <?php
                                                     }
                                                  ?>
                                                  /> 
                                                   
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
                                <input type="text" name="cno1" id="cno1" class="form-control" value="<?php echo $userrow["user_cno1"];?>"/> <!--   Enter CNO 1 -->
                            </div>
                            
                            <div class="col-md-2">
                                <label class="control-label"> Contact Mobile</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="cno2" id="cno2" class="form-control" value="<?php echo $userrow["user_cno2"];?>"/> <!--   Enter CNO 2 -->
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
                                <option value="<?php echo $role_row["role_id"]; ?>" 
                                        <?php
                                        if ($userrow["role_id"]==$role_row["role_id"]) //user's role id is equals to the role rows role id
                                            {
                                            
                                            ?>
                                        
                                        selected="selected" 
                                        
                                        <?php
                                        
                                            //user role get selected
                                        }
                                        
                                        ?>
                                        
                                        
                                        
                                        ><?php echo $role_row["role_name"]?></option>
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
                                <img id="imgprev" src="../images/user_images/<?php echo $userimage   ?>" width="60" height="80"/>
                           
                                <input type="hidden" name="prev_image" value="<?php echo $userimage   ?>" />
                            </div>                      <!--   Enter User image -->
                            
                            
                            
                            
                        </div>
                            
                            <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                            
                        
                        
                        <div class="row">
                                <div class="col-md-12" id="cont">
                            <?php 
                            
                            $role_id=$userrow["role_id"];      // to get user functions with modules
                            
           $moduleResult=$userObj->getModulesByRole($role_id);
           
           while($module_row=$moduleResult->fetch_assoc())
           {
               $module_id=$module_row["module_id"];
               
               $functionResult=$userObj->getModuleFunctions($module_id);
               
                             ?>  
                <div class="col-md-4">
                    <label class="control-label"><?php  echo $module_row["module_name"];  ?></label>    <!-- GET modules -->
                    <br/>
                    <?php
                        while($function_row=$functionResult->fetch_assoc())
                        {
                          ?>
                    <input type="checkbox" class="userfunctions" name="user_function[]" value="<?php echo $function_row["function_id"]; ?>"
                           
                           <?php
                           if(in_array($function_row["function_id"], $userfunctionArray))                   //user assigned functions
                           {
                           
                           ?>
                           checked="checked"
                           <?php
                           
                           }
                           ?>
                           />
                    &nbsp; <?php echo ucwords($function_row["function_name"]);  ?>
                        <br/>
                            <?php
                        }
                    
                    ?>
                </div>
                              <?php
                        }
                    
                    ?>
                    
              
           
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


