<?php

include '../commons/sessions.php';


if (!isset($_GET["status"])) {

?>
    <script>
        window.location = "../view/login.php"
    </script>
    <?php
} else {
    include '../model/category_model.php';
    include '../model/brand_model.php';
    include '../model/product_model.php';
    include '../model/stock_model.php';

    $stockObj = new Stock();
    $categoryObj = new Category();
    $brandObj = new Brand();
    $productObj = new Product();
    $status = $_REQUEST["status"];

    switch ($status) {
        case "add_category":
            try {
                $cat_name = $_POST["cat_name"];
                if ($cat_name == "") {
                    throw new Exception("Category name Cannot Be Empty !!!");
                }

                $cat_id = $categoryObj->addCategory($cat_name);
                if ($cat_id > 0) {
                    $msg = "Category $cat_name Added Succesfully!";
                    $msg =  base64_encode($msg);
    ?>
                    <script>
                        window.location = "../view/categories.php?msg=<?php echo $msg; ?>"
                    </script>
                <?php
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                ?>
                <script>
                    window.location = "../view/categories.php?msg=<?php echo $msg; ?>"
                </script>
                <?php
            }
            break;

        case "add_brand":

            try {

                $brand_name = $_POST["brand_name"];
                if ($brand_name == "") {
                    throw new Exception("Brand Name cannot Be Empty!!");
                }

                $brand_id = $brandObj->addBrand($brand_name);
                if ($brand_id > 0) {
                    $msg = "Brand $brand_name Added Succesfully!";
                    $msg =  base64_encode($msg);
                ?>
                    <script>
                        window.location = "../view/categories.php?msg=<?php echo $msg; ?>"
                    </script>
                <?php
                } else {
                    throw new Exception("Brand Name Already Exists!!!");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();

                $msg =  base64_encode($msg);
                ?>
                <script>
                    window.location = "../view/categories.php?error=<?php echo $msg; ?>"
                </script>
            <?php

            }

            break;

        case "load_category":
            $cat_id = $_POST["cat_id"];

            $categoryResult = $categoryObj->getSpecificCategory($cat_id);
            $cat_row = $categoryResult->fetch_assoc();
            ?>
            <input type="hidden" name="cat_id" value="<?php echo $cat_id ?>" />
            <div class="row">
                <div class="col-md-3">
                    <label>Category Name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="cat_name" value="<?php echo $cat_row["cat_name"];   ?>" />
                </div>
            </div>


        <?php
            break;

        case "update_category":

            $cat_name = $_POST["cat_name"];
            $cat_id = $_POST["cat_id"];

            $categoryObj->updateCategory($cat_id, $cat_name);

            $msg = "Category updated Successfully !!!";
            $msg = base64_encode($msg);
        ?>
            <script>
                window.location = "../view/categories.php?msg=<?php echo $msg; ?>"
            </script>
        <?php
            break;

        case "load_brand":
            $brand_id = $_POST["brand_id"];

            $brandResult = $brandObj->getSpecificBrand($brand_id);

            $brand_row = $brandResult->fetch_assoc();
        ?>
            <div class="row">
                <input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>" />
                <div class="col-md-3">
                    <label>Brand Name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="brand_name" value="<?php echo $brand_row['brand_name'];  ?>" />
                </div>
            </div>


        <?php

            break;

        case "update_brand":

            $brand_id = $_POST["brand_id"];
            $brand_name = $_POST["brand_name"];

            $brandObj->updateBrand($brand_id, $brand_name);
            $msg = "Brand Updated Successfully!!!";
            $msg =  base64_encode($msg);
        ?>
            <script>
                window.location = "../view/categories.php?msg=<?php echo $msg; ?>"
            </script>
        <?php

        case "generate_barcode":
            $barcode = $_POST["barcode"];
            $barcode =  urlencode($barcode);

        ?>

            <img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $barcode;  ?>&code=Code128&multiplebarcodes=false&translate-esc=true&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=Default&qunit=Mm&quiet=0&hidehrt=False&dmsize=Default' width="200px" height="120px" />

            <?php

            break;

        case "validate_barcode":

            $barcode = $_POST["barcode"];


            $valid = $productObj->validateExistingBarcode($barcode);

            if ($valid) {
            ?>
                <label class="label label-success">Barcode is Available </label>

            <?php
            } else {
            ?>
                <label class="label label-danger">Barcode is Not Available </label>
                <?php
            }


            break;
        case "add_product":

            $prname = $_POST["prname"];
            $barcode = $_POST["barcode"];
            $cat_id = $_POST["cat_id"];
            $brand_id = $_POST["brand_id"];
            $unit_id = $_POST["unit_id"];
            $price = $_POST["price"];
            $product_image;
            $imagename = $_FILES["product_image"]["name"];

            try {

                $target_dir = "../controller/uploads/";
                $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }

                // Check file size
                if ($_FILES["product_image"]["size"] > 5000000) {
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

                    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["product_image"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }

                // echo "<br>" . $prname . "<br>" . $barcode . "<br>" . $cat_id . "<br>" . $brand_id . "<br>" . $unit_id . "<br>" . $price . "<br>" . $imagename;

                $product_id = $productObj->addProduct($prname, $barcode, $cat_id, $brand_id, $unit_id, $price, $imagename);
                if ($product_id > 0) {
                    $msg = "Product Successfully Added!!!";
                    $msg =  base64_encode($msg);
                ?>
                    <script>
                        window.location = "../view/view-products.php?msg=<?php echo $msg; ?>"
                    </script>
                <?php
                }
            } catch (Exception $ex) {
            }

            break;


        case "update_product":

            $prname = $_POST["prname"];
            $barcode = $_POST["barcode"];
            $cat_id = $_POST["cat_id"];
            $brand_id = $_POST["brand_id"];
            $unit_id = $_POST["unit_id"];
            $price = $_POST["price"];
            $recode_id = $_GET["recode_id"];
            $product_image = $_GET["product_img"];
            $imagename = $_FILES["product_image"]["name"];

            echo trim($imagename);

            if (trim($imagename) == ""){
                echo "cccccccccccccccccccc". $product_image;
                $imagename = $product_image;
            }

            ?>
                <script type="text/javascript">
                    console.log(<?php echo $price; ?>);
                </script>
            <?php

            try {
                if ($prname == "") {
                    throw new Exception("Product Id can not be Empty!!!");
                }

                if ($barcode == "") {
                    throw new Exception("barcode not be Empty!!!");
                }

                if ($cat_id == "") {
                    throw new Exception("category id can not be is Empty!!!");
                }
                if ($brand_id == "") {
                    throw new Exception("brand id can not be Empty!!!");
                }

                if ($unit_id == "") {
                    throw new Exception("unit id can not be Empty!!!");
                }

                if ($price == "") {
                    throw new Exception("price can not be Empty!!!");
                }

                ///  regular Expression validation
                $date = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
                $numberOnly = "/^[+-]?([0-9]+\.?[0-9]*|\.[0-9]+)$/";
                $timeOnly = "/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/";
                $byGivenLength = "/^\s*(?:\S\s*){10,500}$/";
                $byGivenLengthForName = "/^\s*(?:\S\s*){1,100}$/";

                if (!preg_match($byGivenLengthForName, $prname)) {
                    throw new Exception("Invalid Product Id Format");
                }

                if (!preg_match($numberOnly, $barcode)) {
                    throw new Exception("Invalid barcod Format");
                }

                if (!preg_match($numberOnly, $cat_id)) {
                    throw new Exception("category id Format");
                }

                if (!preg_match($byGivenLengthForName, $brand_id)) {
                    throw new Exception("brand id is Invalid!!!");
                }

                if (!preg_match($byGivenLengthForName, $unit_id)) {
                    throw new Exception("unit id is Invalid!!!");
                }

                if (!preg_match($numberOnly, $price)) {
                    throw new Exception("price is Invalid!!!");
                }
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg =  base64_encode($msg);
                echo $price;
                ?>
                    <script>
                        window.location = "../view/view-products.php?msg=<?php echo $msg; ?>"
                    </script>
                <?php
                break;
            }

            try {

                if (trim($imagename) != ""){
                    
                
                    $target_dir = "../controller/uploads/";
                    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    if (isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
                        if ($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }

                    // Check file size
                    if ($_FILES["product_image"]["size"] > 5000000) {
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

                        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                            echo "The file " . htmlspecialchars(basename($_FILES["product_image"]["name"])) . " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                }

                // echo "<br>" . $prname . "<br>" . $barcode . "<br>" . $cat_id . "<br>" . $brand_id . "<br>" . $unit_id . "<br>" . $price . "<br>" . $product_image;

                $product_id = $productObj->modifyCommidity($prname, $barcode, $cat_id, $brand_id, $unit_id, $price, $imagename, $recode_id);
                if ($product_id > 0) {
                    $msg = "Product Successfully Added!!!";
                    $msg =  base64_encode($msg);
                    echo "cvcvcv";
                ?>
                    <script>
                        window.location = "../view/view-products.php?msg=<?php echo $msg; ?>"
                    </script>
            <?php
                }
            } catch (Exception $ex) {


            }

            break;


        case "deactivate":
            $recode_id = $_GET["recode_id"];
            $productObj->deactivateInventoryItem($recode_id);
            echo "dfdfd";
            $msg = "succssfully deactivated";
            ?>
            <script>
                window.location = "../view/view-products.php?msg=<?php echo $msg; ?>";
            </script>
        <?php

            break;

        case "activate":
            $recode_id = $_GET["recode_id"];
            $productObj->activateInventoryItem($recode_id);
            $msg = "succssfully activated";
        ?>
            <script>
                window.location = "../view/view-products.php?msg=<?php echo $msg; ?>";
            </script>
        <?php

            break;

        case "load_stock_modal":
            $product_id = $_POST["product_id"];

            $productResult = $productObj->getSpecificProduct($product_id);
            $product_row = $productResult->fetch_assoc();
        ?>
            <input type="hidden" name="product_id" value="<?php echo $product_row["product_id"]; ?>" />
            <div class="row">
                <div class="col-md-6">
                    <label>Product Name : <?php echo ucwords($product_row["product_name"]);  ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Stock Date</label>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="stock_date" max="<?php echo date("Y-m-d"); ?>" /> <!--  to add the date to validate data -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Added Quantity</label>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="stock_qty" />
                        <span class="input-group-addon">
                            <?php echo $product_row["unit_name"]; ?>
                        </span>
                    </div>
                </div>
            </div>
<?php
            break;
        case "add_stock":
            $product_id = $_POST["product_id"];
            $stock_date = $_POST["stock_date"];
            $stock_qty = $_POST["stock_qty"];

            $stockObj->addStock($product_id, $stock_qty, $stock_date);

            break;
        case "send_email":

            include '../includes/email_includes.php';
            $receiver = "ponnamperumaanjana97@gmail.com";
            $username = "ponnamperumaanjana97@gmail.com";
            $mail->setFrom('mail@et.lk', 'Grocery manament System');
            $mail->addReplyTo('mail@et.lk', 'Grocery manament System');
            $mail->addAddress($username);   // Add a recipient
            $mail->addAddress($username);   // Add a recipient


            // $mail->addCC($client_email);
            $mail->addBCC('bcc@example.com');

            $mail->AddAttachment('../documents/stock_report/stock_report');

            $mail->Subject = 'StockE Report';


            $mail->isHTML(true);  // Set email format to HTML
            $body = "<h1>Hi</h1>";
            $body .= "<img src='https://i0.wp.com/onlymyenglish.com/wp-content/uploads/types-of-vehicles.png' width='200px' height='80px' />";

            $body .= "<p>Dear Sir/Madam,<br> Please find the attached stock Report</p>";
            $mail->Body  = $body;
            if ($mail->send()) {
                echo "Mail Successfully Sent!!!";
            }

            break;
    }
}
