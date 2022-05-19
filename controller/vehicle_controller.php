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

    include_once '../model/vehicle_model.php';
    $vehicleObj = new Vehicle();

    $status = $_REQUEST["status"];

    switch ($status) {


        case "add_deal":

            $vid = $_POST["vid"];
            $vname = $_POST["vname"];
            $customername = $_POST["customername"];
            $arrivalDate = $_POST["arrivalDate"];
            $arrivalTime = $_POST["arrivalTime"];
            $deliverydate = $_POST["deliverydate"];
            $deliverytime = $_POST["deliverytime"];
            $issue = $_POST["issue"];
            $charge = $_POST["charge"];
            $photo = $_FILES["photo"]["name"];

            $vehicleObj->addNewDeal($vid, $vname, $customername, $arrivalDate, $arrivalTime, $deliverydate, $deliverytime, $charge, $issue, $photo);
            $msg = "Vehicle Data Recoded";

            $target_dir = "../controller/uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["photo"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {

                if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }


            // echo $vid . "<br>" . $vname . "<br>" . $customername . "<br>" . $arrivalDate . "<br>" . $arrivalTime . "<br>" . $deliverydate . "<br>" . $deliverytime . "<br>" . $charge . "<br>" . $issue . "<br>" . $photo;
            $msg = "success";
    ?>
            <script>
                window.location = "../view/addnewdeal.php?msg=<?php echo $msg; ?>";
            </script>
        <?php

            break;


        case "modify_deal":
            $recode_id = $_GET["recode_id"];
            $vid = $_POST["vid"];
            $vname = $_POST["vname"];
            $customername = $_POST["customername"];
            $arrivalDate = $_POST["arrivalDate"];
            $arrivalTime = $_POST["arrivalTime"];
            $deliverydate = $_POST["deliverydate"];
            $deliverytime = $_POST["deliverytime"];
            $issue = $_POST["issue"];
            $charge = $_POST["charge"];
            $photo = $_FILES["photo"]["name"];
            $photopill = $_GET["photo"];

            if ($_FILES["photo"]["name"] == ""){
                echo $recode_id;
                $vehicleObj->modifyDeal($vid, $vname, $customername, $arrivalDate, $arrivalTime, $deliverydate, $deliverytime, $charge, $issue, $photopill, $recode_id);
                ?>
                    <script>
                        window.location = "../view/serviceschedule.php?msg=success&pagination_number=0";
                    </script>
                <?php
            }else{
                $vehicleObj->modifyDeal($vid, $vname, $customername, $arrivalDate, $arrivalTime, $deliverydate, $deliverytime, $charge, $issue, $photo, $recode_id);
            }

            $msg = "Vehicle Data Recoded";

            $target_dir = "../controller/uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            // if (file_exists($target_file)) {
            //     echo "Sorry, file already exists.";
            //     $uploadOk = 0;
            // }

            // Check file size
            if ($_FILES["photo"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {

                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }


            // echo $vid . "<br>" . $vname . "<br>" . $customername . "<br>" . $arrivalDate . "<br>" . $arrivalTime . "<br>" . $deliverydate . "<br>" . $deliverytime . "<br>" . $charge . "<br>" . $issue . "<br>" . $photo;
            $msg = "success";
        ?>
            <script>
                window.location = "../view/serviceschedule.php?msg=<?php echo $msg; ?>&pagination_number=0";
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
            $vehicleObj->finishDealOfAVehicle($recode_id, $field_name, $data);
            $msg = "succssfully updated";
        ?>
            <script>
                window.location = "../view/serviceschedule.php?msg=<?php echo $msg; ?>&pagination_number=<?php echo $paginationNumber ?>";
            </script>
        <?php

            break;


        case "delete":
            $recode_id = $_GET["recode_id"];
            $vehicle_id = $_GET["vehicle_id"];
            $status = $_GET["status"];
            $paginationNumber = $_GET["pagination_number"];
            $vehicleObj->removeVehicleRecodeFunctions($recode_id);
            echo $recode_id . $vehicle_id . $status . "\n";
            $msg = "succssfully deleted";
        ?>
            <script>
                window.location = "../view/serviceschedule.php?msg=<?php echo $msg; ?>&pagination_number=<?php echo $paginationNumber ?>";
            </script>
<?php

            break;
    }
}
