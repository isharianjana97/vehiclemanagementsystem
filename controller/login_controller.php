
<?php

include '../commons/sessions.php';

if(!isset($_GET["status"]))
{        

   ?>
<script> window.location="../view/login.php"</script>
    <?php
}
else{
    include  '../model/login_model.php'; 
    include '../model/user_model.php';
    $loginObj=new Login();
    $userObj=new User();
        /// the get variable is available
    
        $status =$_GET["status"];
        switch ($status){
        case "login":
            
            try {
            if((!isset($_POST["username"])) || ($_POST["username"]==""))
                {                   
                    throw new Exception("Username Cannot Be Empty!!!");
                
                }
                if((!isset($_POST["password"])) || ($_POST["password"]==""))
                  {                   
                    throw new Exception("Password Cannot Be Empty!!!");
                
                }
                
            $username=$_POST["username"];
            $password=$_POST["password"];
            
        $userId= $loginObj->checkUserExistence($username, $password);
        
        if(!($userId>=1))   // check if we have a valid user id
        {    
           
            throw new Exception("User Does Not Exist !!!");
        
            }
               else{
                  
                   $moduleResult=$userObj->getUserModules($userId);
                   $moduleArray=[];
               while($module_row = $moduleResult->fetch_assoc())
                           
                {
                    array_push($moduleArray, $module_row);  
                } 
              // print_r($moduleArray);
              // die();
                
                //user module info
        $_SESSION['user_module']=$moduleArray;
                //user info
        $userResult=$userObj->getUserById($userId);
        
        $userrow=$userResult-> fetch_assoc();
        
        $_SESSION["user"]=$userrow;
        
        ?>
        <script>window.location="../view/dashboard.php"</script>


        <?php
            }
        
                
            } catch (Exception $ex) {
                 $msg=$ex->getMessage();
                 $msg= base64_encode($msg);
                
                ?>
               <script> window.location="../view/login.php?msg=<?php echo $msg; ?>"</script>
                <?php
            }
            break;
     } 
}