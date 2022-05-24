<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray = $_SESSION["user_module"];

include_once '../model/user_model.php';
$userObj = new User();
$roleResult = $userObj->getUserRoles();

include '../model/category_model.php';
include '../model/brand_model.php';
include '../model/product_model.php';
$categoryObj = new Category();
$brandObj = new Brand();
$productObj = new Product();
$unitResult = $productObj->getAllUnits();


$categoryResult = $categoryObj->getAllCategories();
$brandResult = $brandObj->getAllBrands();


?>
<html>

<head>
    <!--  include bootstrap css   -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="../images/iconset/name.png" width="200px" height="100px" />
            </div>
            <div class="col-md-8">
                <h1 align="center"> PM Automobile Management System </h1>
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-2"><span class="glyphicon glyphicon-user"></span>

                &nbsp;
                <?php
                echo ucwords($_SESSION["user"]["user_fname"] . " " . $_SESSION["user"]["user_lname"]);
                ?>
            </div>
            <div class="col-md-8">
                <h4 align="center"> Update Product </h4>
            </div>
            <div class="col-md-2">
                <span class="glyphicon glyphicon-bell"></span>
                &nbsp;
                <button class="btn btn-primary"> Logout</button>
            </div>
        </div>
        <hr />
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
                include_once '../includes/main-product-navigation.php';
                ?>
            </div>
            <div class="col-md-9">
                <form action="../controller/product_controller.php?status=update_product&recode_id=<?php echo $_GET['recode_id'] ?>&product_img=<?php echo $_GET["product_img"]; ?>" enctype="multipart/form-data" method="post">

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="alertdiv">&nbsp;</div> <!-- Display alert message-->
                    </div>

                    <!-- to display alert messages -->
                    <?php
                    if (isset($_GET["msg"])) {

                        $msg = base64_decode($_GET["msg"]);
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

                    <div class="row">
                        <!--   Enter first name and the last name -->
                        <div class="col-md-2">
                            <label class="control-label"> Commodity Name </label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="prname" id="prname" class="form-control" value="<?php echo $_GET['product_name']; ?>" />
                        </div>

                        <div class="col-md-2">
                            <label class="control-label"> Barcode Number</label> <!--   Enter barcode name -->
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="barcode" id="barcode" class="form-control" required="required" value="<?php echo $_GET['recode_id']; ?>" />
                            <span id="display validate"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"> &nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success" id="generatebtn">
                                <span class="glyphicon glyphicon-refresh"></span> &nbsp;Generate
                            </button>

                        </div>
                        <div class="col-md-8" id="displaybarcode">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"> &nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Category</label>
                                <select class="form-control" id="cat_id" name="cat_id">
                                    <?php
                                    while ($cat_row = $categoryResult->fetch_assoc()) {
                                        if ($cat_row["cat_name"] == $_GET["cat_name"]) {
                                    ?>
                                            <option value="<?php echo $cat_row["cat_id"]; ?>" selected>
                                                <?php echo $cat_row["cat_name"]; ?>
                                            </option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $cat_row["cat_id"]; ?>">
                                                <?php echo $cat_row["cat_name"]; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>


                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Brand</label>
                                <select class="form-control" id="brand_id" name="brand_id">
                                    <?php
                                    while ($brand_row = $brandResult->fetch_assoc()) {

                                        if ($brand_row["brand_name"] == $_GET["brand_name"]) {
                                    ?>
                                            <option value="<?php echo $brand_row["brand_id"]; ?>" selected>
                                                <?php echo $brand_row["brand_name"]; ?>
                                            </option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $brand_row["brand_id"]; ?>">
                                                <?php echo $brand_row["brand_name"]; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    <?php

                                    }
                                    ?>
                                </select>

                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Unit</label>
                                <select class="form-control" id="unit_id" name="unit_id">
                                    <?php
                                    while ($unit_row = $unitResult->fetch_assoc()) {
                                        if ($unit_row["unit_name"] == $_GET["unit_name"]) {
                                    ?>
                                            <option value="<?php echo $unit_row["unit_id"]; ?>" selected>
                                                <?php echo $unit_row["unit_name"];  ?>
                                            </option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $unit_row["unit_id"]; ?>">
                                                <?php echo $unit_row["unit_name"];  ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    <?php

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"> &nbsp;</div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label"> Price</label>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"> Rs </span>
                                <input type="text" class="form-control" name="price" id="price" value="<?php echo $_GET["product_price"]; ?>"/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="control-label"> Product Image</label>
                        </div>

                        <div class="col-md-3">
                            <input type="file" class="form-control" name="product_image" onchange="readImage(this);" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-9">
                            </br>
                            <img id="imgprev" src="../controller/uploads/<?php echo $_GET["product_img"]; ?>" width="120px" height="80px" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12"> &nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                            <input type="submit" class="btn btn-success" value="save" /> &nbsp;
                            <!--   Enter Submit -->
                            <input type="reset" class="btn btn-danger" value="reset" /> <!--   Enter Reset -->
                        </div>
                    </div>

                </form>


            </div>

        </div>
    </div>
</body>
<!--   include jquery -->
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/productvalidation.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

<script>
    function
    readImage(input) {
        //check if I have selected a file
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#imgprev")
                    .attr('src', e.target.result)
                    .width(120)
                    .height(80)
            };
            reader.readAsDataURL(input.files[0])
        }
    }
</script>

</html>