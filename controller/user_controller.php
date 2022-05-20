<?php

include '../commons/sessions.php';

if (!isset($_GET["status"])) {

?>
    <script>
        window.location = "../view/login.php"
    </script>
<?php
} else {

?>
    <div class="spinner-border text-light" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <?php

    include_once '../model/user_model.php';
    $userObj = new User();

    $status = $_REQUEST["status"];

    switch ($status) {
        case "get_functions":

            $role_id = $_POST["role_id"];



            $moduleResult = $userObj->getModulesByRole($role_id);

            while ($module_row = $moduleResult->fetch_assoc()) {
                $module_id = $module_row["module_id"];

                $functionResult = $userObj->getModuleFunctions($module_id);

    ?>
                <div class="col-md-4">
                    <label class="control-label"><?php echo $module_row["module_name"];  ?></label> <!-- GET modules -->
                    <br />
                    <?php
                    while ($function_row = $functionResult->fetch_assoc()) {
                    ?>
                        <input type="checkbox" class="userfunctions" name="user_function[]" value="<?php echo $function_row["function_id"]; ?>" checked="checked" />
                        &nbsp; <?php echo ucwords($function_row["function_name"]);  ?>
                        <br />
                    <?php
                    }

                    ?>

                </div>
                <?php
            }

            break;

        case "add_user":

            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $nic = $_POST["nic"];
            $cno1 = $_POST["cno1"];
            $cno2 = $_POST["cno2"];
            $user_role = $_POST["user_role"];
            $user_function = $_POST["user_function"];
            $gender = $_POST["gender"];



            try {
                if ($fname == "") {
                    throw new Exception("First Name is Empty!!!");
                }

                if ($lname == "") {
                    throw new Exception("Last Name is Empty!!!");
                }
                if ($nic == "") {
                    throw new Exception("NIC is Empty!!!");
                }
                if ($cno1 == "") {

                    throw new Exception("Contact Number 1 Cannot be Empty!");
                }
                if ($cno2 == "") {

                    throw new Exception("Contact Number 2 Cannot be Empty!");
                }
                if ($user_role == "") {

                    throw new Exception("User Role Cannot be Empty!");
                }
                if (sizeof($user_function) == 0) {
                    throw new Exception("A USer Function Must Be Selected");
                }

                // above  size of get the lenght of the array
                ///  regular Expression validation
                $patnic = "/[0-9]{9}[vVxX]$/";
                $patcno1 = "/^\+94[0-9]{9}$/";
                $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";

                // first parameter is the pattern 2nd one is the variable
                if (!preg_match($patnic, $nic)) {
                    throw new Exception("Invalid NIC Format");
                }

                if (!preg_match($patcno1, $cno1)) {
                    throw new Exception("Contact Number 1 is Invalid!!!");
                }

                if (!preg_match($patemail, $email)) {

                    throw new Exception("Invalid Email");
                }



                ///  file uploading


                if (isset($_FILES["user_img"]))  //  already selected a file
                {

                    $imagename = $_FILES["user_img"]["name"];  //  image name
                    //  appending current timestamp to make the image unique

                    $imagename = "" . time() . "_" . $imagename;

                    $tmp_path = $_FILES["user_img"]["tmp_name"];  //  tempory location

                    //  upload to the given server directory

                    $destination = "../images/user_images/$imagename";

                    move_uploaded_file($tmp_path, $destination);

                    //  $previousImage=$_POST["prev_image"];    

                    //  unlink("../images/user_images/$previousImage"); //  remove file from server


                } else {
                    //  no image is selected
                    $imagename = "";
                }


                $user_id = $userObj->addUser($fname, $lname, $email, $gender, $nic, $cno1, $cno2, $imagename, $user_role); //Calling the function
                if ($user_id > 0) {
                    $userObj->addUserLogin($user_id, $email, $nic);


                    ////  if user is added succesfully

                    //  looping through user functions

                    foreach ($user_function as $f) {
                        echo $f;
                        $userObj->addUserFunction($user_id, $f);
                    }

                    $msg = "User Added Succesfully";
                    $msg =  base64_encode($msg);
                ?>
                    <script>
                        window.location = "../view/view-users.php?msg=<?php echo $msg; ?>"
                    </script>
                <?php
                } else {

                    throw new Exception("User Not Inserted Succesfully!");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();

                $msg =  base64_encode($msg);

                ?>
                <script>
                    window.location = "../view/add-user.php?msg=<?php echo $msg; ?>"
                </script>
            <?php

            }



            break;

        case "deactivate":
            $user_id = base64_decode($_GET["user_id"]);

            $userObj->deactivateUser($user_id);
            $msg = "User Succesfully Deactivated";
            ?>
            <script>
                window.location = "../view/view-users.php?msg=<?php echo $msg; ?>"
            </script>
        <?php
            break;

        case "activate":
            $user_id = base64_decode($_GET["user_id"]);

            $userObj->activateUser($user_id);
            $msg = "User Succesfully Activated";
        ?>
            <script>
                window.location = "../view/view-users.php?msg=<?php echo $msg; ?>"
            </script>
            <?php
            break;

        case "update_user":


            $user_id = $_POST["user_id"];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $nic = $_POST["nic"];
            $cno1 = $_POST["cno1"];
            $cno2 = $_POST["cno2"];
            $user_role = $_POST["user_role"];
            $user_function = $_POST["user_function"];
            $gender = $_POST["gender"];

            try {
                if ($fname == "") {
                    throw new Exception("First Name is Empty!!!");
                }

                if ($lname == "") {
                    throw new Exception("Last Name is Empty!!!");
                }
                if ($nic == "") {
                    throw new Exception("NIC is Empty!!!");
                }
                if ($cno1 == "") {

                    throw new Exception("Contact Number 1 Cannot be Empty!");
                }
                if ($cno2 == "") {

                    throw new Exception("Contact Number 2 Cannot be Empty!");
                }
                if ($user_role == "") {

                    throw new Exception("User Role Cannot be Empty!");
                }
                if (sizeof($user_function) == 0) {
                    throw new Exception("A USer Function Must Be Selected");
                }


                ///  regular Expression validation
                $patnic = "/[0-9]{9}[vVxX]$/";
                $patcno1 = "/^\+94[0-9]{9}$/";
                $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";

                if (!preg_match($patnic, $nic)) {
                    throw new Exception("Invalid NIC Format");
                }

                if (!preg_match($patcno1, $cno1)) {
                    throw new Exception("Contact Number 1 is Invalid!!!");
                }

                if (!preg_match($patemail, $email)) {

                    throw new Exception("Invalid Email");
                }



                ///  file uploading

                if ($_FILES["user_img"]["name"] != "")  //  already selected a file
                {

                    $imagename = $_FILES["user_img"]["name"];  //  image name
                    //  appending current timestamp to make the image unique

                    $imagename = "" . time() . "_" . $imagename;

                    $tmp_path = $_FILES["user_img"]["tmp_name"];  //  tempory location

                    //  upload to the given server directory

                    $destination = "../images/user_images/$imagename";

                    move_uploaded_file($tmp_path, $destination);

                    $previousImage = $_POST["prev_image"];

                    unlink("../images/user_images/$previousImage"); //  remove file from server & pass the path


                } else {
                    //  no image is selected
                    $imagename = "";
                }

                $userObj->updateUser($user_id, $fname, $lname, $email, $gender, $nic, $cno1, $cno2, $imagename, $user_role);  //pass update user functions 


                $userObj->removeUserFunctions($user_id);   ///  delete assigned functions


                foreach ($user_function as $f) {
                    //functions are deleted
                    $userObj->addUserFunction($user_id, $f);     //loop for user functions

                }

                $msg = "User $fname is Successfully Updated!";
                $msg =  base64_encode($msg);  //go back to the view user's page
            ?>


                <script>
                    window.location = "../view/view-users.php?msg=<?php echo $msg; ?>"
                </script> <!-- Send back to view users page -->
            <?php




            } catch (Exception $ex) {


                $msg = $ex->getMessage();

                $msg =  base64_encode($msg);

            ?>
                <script>
                    window.location = "../view/edit-user.php?msg=<?php echo $msg; ?>"
                </script> <!-- Send back to edit users page -->
            <?php
            }

            break;

        case "leave":
            $user_id = base64_decode($_GET["user_id"]);
            $recode_id = $_GET["recode_id"];
            $paginationNumber = $_GET["pagination_number"];

            $userObj->setLeaveUser($user_id, $recode_id);
            $msg = "User Data Recoded";
            ?>
            <script>
                window.location = "../view/hr.php?msg=<?php echo $msg; ?>&pagination_number=<?php echo $paginationNumber ?>"
            </script>
            <?php
            break;

        case "arrive":
            $user_id = $_POST["userId"];
            $arrivalDate = $_POST["arrivalDate"];
            $arrivalTime = $_POST["arrivalTime"];
            $paginationNumber = $_GET["pagination_number"];


            try {
                if ($user_id == "") {
                    throw new Exception("User Id can not be Empty!!!");
                }

                if ($arrivalDate == "") {
                    throw new Exception("arrival date is Empty!!!");
                }
                if ($arrivalTime == "") {
                    throw new Exception("arrival time is Empty!!!");
                }

                ///  regular Expression validation
                $date = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
                $numberOnly = "/^[1-9]\d*$/";
                $timeOnly = "/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/";

                if (!preg_match($date, $arrivalDate)) {
                    throw new Exception("Invalid arrival date Format");
                }

                if (!preg_match($timeOnly, $arrivalTime)) {
                    throw new Exception("Invalid arrival time Format");
                }

                if (!preg_match($numberOnly, $user_id)) {
                    throw new Exception("User Id is Invalid!!!");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                echo $arrivalTime;
                $msg =  base64_encode($msg);
            ?>
                <script>
                    window.location = "../view/hr.php?msg=<?php echo $msg; ?>&pagination_number=<?php echo $paginationNumber ?>"
                </script>
            <?php
                break;
            }

            try {
                $userObj->setArrivedUser($user_id, $arrivalDate, $arrivalTime);
            } catch (Exception $ex) {
                $msg = "User doesn't exist";
                $msg =  base64_encode($msg);
            ?>
                <script>
                    window.location = "../view/hr.php?&msg=<?php echo $msg; ?>pagination_number=<?php echo $paginationNumber ?>"
                </script>
            <?php
            }

            $msg = "User Data Recoded";
            $msg =  base64_encode($msg);
            ?>
            <script>
                window.location = "../view/hr.php?&pagination_number=<?php echo $paginationNumber; ?>"
            </script>
            <?php
            break;

        case "payment":
            $user_id = trim($_POST["userId"]);
            $amount = trim($_POST["amount"]);
            $arrivalDate = trim($_POST["arrivalDate"]);
            $arrivalTime = trim($_POST["arrivalTime"]);
            $paginationNumber = trim($_GET["pagination_number"]);

            try {
                if ($user_id == "") {
                    throw new Exception("User Id can not be Empty!!!");
                }

                if ($amount == "") {
                    throw new Exception("Amount can not be Empty!!!");
                }

                if ($arrivalDate == "") {
                    throw new Exception("arrival date is Empty!!!");
                }
                if ($arrivalTime == "") {
                    throw new Exception("arrival time is Empty!!!");
                }

                ///  regular Expression validation
                $date = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
                $numberOnly = "/^[1-9]\d*$/";
                $timeOnly = "/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/";

                if (!preg_match($date, $arrivalDate)) {
                    throw new Exception("Invalid arrival date Format");
                }

                if (!preg_match($numberOnly, $amount)) {
                    throw new Exception("Invalid amount Format");
                }

                if (!preg_match($timeOnly, $arrivalTime)) {
                    throw new Exception("Invalid arrival time Format");
                }

                if (!preg_match($numberOnly, $user_id)) {
                    throw new Exception("User id is Invalid!!!");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                echo $arrivalTime;
                $msg =  base64_encode($msg);
            ?>
                <script>
                    window.location = "../view/salaries.php?msg=<?php echo $msg; ?>&pagination_number=<?php echo $paginationNumber ?>"
                </script>
            <?php
                break;
            }

            try {
                $userObj->setPaidUser($user_id, $amount, $arrivalDate, $arrivalTime);
            } catch (Exception $ex) {
                $msg = "User Doesn't exist";
                $msg =  base64_encode($msg);
            ?>
                <script>
                    window.location = "../view/salaries.php?msg=<?php echo $msg; ?>&pagination_number=<?php echo $paginationNumber ?>"
                </script>
            <?php
            }
            $msg = "User Salary Data Recoded";

            ?>
            <script>
                window.location = "../view/salaries.php?msg=<?php echo $msg; ?>&pagination_number=<?php echo $paginationNumber ?>"
            </script>
<?php
            break;
    }
}
