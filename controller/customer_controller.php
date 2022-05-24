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

    include_once '../model/customer_model.php';
    $customerObj = new Customer();

    $status = $_REQUEST["status"];

    switch ($status) {

        case "add_customer":
            $customer_fname = $_POST["customer_fname"];
            $customer_lname = $_POST["customer_lname"];
            
            $customer_email = $_POST["customer_email"];
            $customer_contact = "+". trim($_POST["customer_contact"]);
            
            echo $customer_ids. "<br>". $customer_fname. "<br>". $customer_lname. "<br>". $customer_email. "<br>". $customer_contact;

            try {
                if ($customer_fname == "") {
                    throw new Exception("Customer first name can not be Empty!!!");
                }

                if ($customer_lname == "") {
                    throw new Exception("Customer last name can not be Empty!!!");
                }

                if ($customer_email == "") {
                    throw new Exception("customer email can not be Empty!!!");
                }

                if ($customer_contact == "") {
                    throw new Exception("customer contract can not be Empty!!!");
                }

                ///  regular Expression validation
                $phone = "/^([+]\d{2})?\d{10}$/";
                $numberOnly = "/^[1-9]\d*$/";
                $timeOnly = "/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/";
                $byGivenLength = "/^\s*(?:\S\s*){10,500}$/";
                $byGivenLengthForName = "/^\s*(?:\S\s*){1,100}$/";
                $emailValidation = "/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/";

                if (!preg_match($byGivenLengthForName, $customer_fname)) {
                    throw new Exception("Invalid customer first name");
                }

                if (!preg_match($byGivenLengthForName, $customer_lname)) {
                    throw new Exception("Invalid customer last name");
                }

                if (!preg_match($emailValidation, $customer_email)) {
                    throw new Exception("Invalid email Format");
                }

                if (!preg_match($phone, $customer_contact)) {
                    throw new Exception("Invalid contact number Format");
                }

            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg =  base64_encode($msg);

                echo $msg;

                ?>
                <script>
                    window.location = "../view/customer.php?msg=<?php echo $msg; ?>&pagination_number=0"
                </script>
                
                <?php
                break;
            }
            
            $customerObj->addCustomer($customer_fname, $customer_lname, $customer_email, $customer_contact);
            $msg = "success";
            ?>
            <script>
                window.location = "../view/customer.php?customer_id=0&msg=<?php echo $msg; ?>&pagination_number=0";
            </script>
        <?php

            break;


        case "modify_customer":
            $customer_ids = $_POST["customer_id"];
            $customer_fname = $_POST["customer_fname"];
            $customer_lname = $_POST["customer_lname"];
            
            $customer_email = $_POST["customer_email"];
            $customer_contact = "+". trim($_POST["customer_contact"]);
            
            $paginationNumber = $_POST["pagination_number"];

            echo $customer_ids. "<br>". $customer_fname. "<br>". $customer_lname. "<br>". $customer_email. "<br>". $customer_contact;

            try {
                if ($customer_fname == "") {
                    throw new Exception("Customer first name can not be Empty!!!");
                }

                if ($customer_lname == "") {
                    throw new Exception("Customer last name can not be Empty!!!");
                }

                if ($customer_email == "") {
                    throw new Exception("customer email can not be Empty!!!");
                }

                if ($customer_contact == "") {
                    throw new Exception("customer contract can not be Empty!!!");
                }

                ///  regular Expression validation
                $phone = "/^([+]\d{2})?\d{10}$/";
                $numberOnly = "/^[1-9]\d*$/";
                $timeOnly = "/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/";
                $byGivenLength = "/^\s*(?:\S\s*){10,500}$/";
                $byGivenLengthForName = "/^\s*(?:\S\s*){1,100}$/";
                $emailValidation = "/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/";

                if (!preg_match($byGivenLengthForName, $customer_fname)) {
                    throw new Exception("Invalid customer first name");
                }

                if (!preg_match($byGivenLengthForName, $customer_lname)) {
                    throw new Exception("Invalid customer last name");
                }

                if (!preg_match($emailValidation, $customer_email)) {
                    throw new Exception("Invalid email Format");
                }

                if (!preg_match($phone, $customer_contact)) {
                    throw new Exception("Invalid contact number Format");
                }

            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg =  base64_encode($msg);
                ?>
                <script>
                    window.location = "../view/customer.php?customer_id=0&msg=<?php echo $msg; ?>&pagination_number=0";
                </script>
                
                <?php
                break;
            }
            
            $customerObj->modifyCustomer($customer_ids, $customer_fname, $customer_lname, $customer_email, $customer_contact);
            $msg = "success";
            ?>
            <script>
                window.location = "../view/customer.php?customer_id=0msg=<?php echo $msg; ?>&pagination_number=0";
            </script>
        <?php

            break;

        case "finish":
            $recode_id = $_GET["recode_id"];
            $vehicle_id = $_GET["vehicle_id"];
            $field_name = $_GET["field_name"];
            $data = $_GET["data"];
            $status = $_GET["status"];
            $paginationNumber = $_GET["pagination_number"];

            // echo $recode_id. "<br>". $vehicle_id . "<br>". $field_name . "<br>". $data . "<br>". $status . "<br>". $paginationNumber;
            $customerObj->finishDealOfAVehicle($recode_id, $field_name, $data);
            $msg = "succssfully updated";
        ?>
            <script>
                window.location = "../view/serviceschedule.php?pagination_number=<?php echo $paginationNumber ?>user_id=0";
            </script>
        <?php

            break;


        case "delete":
            $recode_id = $_GET["customer_id"];
            $vehicle_id = $_GET["vehicle_id"];
            $status = $_GET["status"];
            $paginationNumber = $_GET["pagination_number"];
            $customerObj->removecustomerRecodeFunctions($recode_id);
            echo $recode_id . $vehicle_id . $status . "\n";
            $msg = "succssfully deleted";
        ?>
            <script>
                window.location = "../view/customer.php?pagination_number=<?php echo $paginationNumber ?>&user_id=0";
            </script>
<?php

            break;
    }
}
