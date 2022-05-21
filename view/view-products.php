<?php
include '../commons/sessions.php';

///  getting product module information
include '../model/product_model.php';
include '../model/stock_model.php';
$productObj = new Product();
$stockObj = new Stock();

if (isset($_GET["msg"])) {
    $return_msg = $_GET["msg"];
} else {
    $return_msg = "";
}
if ($return_msg != "") {
    $return_msg = base64_decode($return_msg);
}


//   getting all products
$productResult = $productObj->getAllProducts();


$moduleArray = $_SESSION["user_module"];
?>
<html>

<head>
    <!--  include bootstrap css   -->
    <!--  include bootstrap css   -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!--   include jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- include bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        loadStock = function(productid) {

            var url = "../controller/product_controller.php?status=load_stock_modal";

            $.post(url, {
                product_id: productid
            }, function(data) {

                $("#stockcont").html(data);

            });

        }


        viewProduct = function(productid) //load category
        {
            var url = "../controller/product_controller.php?status=view_product";
            $.post(url, {
                product_id: productid
            }, function(data) {

                $("#dynamicviewproduct").html(data);

            });
        }
    </script>
</head>

<body>
    <div class="container">

        <?php
        if ($return_msg != "") {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $return_msg ?>
            </div>
        <?php
        }
        ?>

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
            <div class="col-md-2">
                <span class="glyphicon glyphicon-user"></span>
                &nbsp;
                <?php
                echo ucwords($_SESSION["user"]["user_fname"] . " " . $_SESSION["user"]["user_lname"]);
                ?>
            </div>
            <div class="col-md-8">
                <h4 align="center"> View Products</h4>
            </div>
            <div class="col-md-2">
                <span class="glyphicon glyphicon-bell"></span>
                &nbsp;
                <button class="btn btn-primary">Logout</button>
            </div>
        </div>
        <hr />
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
                include_once '../includes/main-product-navigation.php';
                ?>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <a href="generated_stock_report.php" class="btn btn-success">
                            <span class="glyphicon glyphicon-book"></span> &nbsp;
                            Generate Stock Report
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="generated_stock_report.php?status=save" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save"></span> &nbsp;
                            Save Stock Report
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="../controller/product_controller.php?status=send_email" class="btn btn-success">
                            <span class="glyphicon glyphicon-envelope"></span> &nbsp;
                            Send As Email
                        </a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <table class="table table-striped" id="usertable">
                    <thead>
                        <tr style="background-color: #1796bd;color: #FFF">
                            <th>&nbsp;</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Available Stock</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($product_row = $productResult->fetch_assoc())   // Product row handling
                        {
                            $product_id = $product_row["product_id"];

                            $tot_qty =  $stockObj->getProductStock($product_id);  //total quantity

                        ?>
                            <tr>

                                <td><img style="width: 100px; height: 100px;" src="../controller/uploads/<?php echo $product_row["product_image"]; ?>"></td>
                                <td><?php echo ucwords($product_row["product_name"]); ?></td>
                                <td><?php echo ucwords($product_row["brand_name"]);  ?></td>
                                <td><?php echo ucwords($product_row["cat_name"]);  ?></td>
                                <td><?php echo "Rs " . $product_row["product_price"]; ?></td>
                                <td>
                                    <?php echo (int)$tot_qty;  ?> <?php echo $product_row["unit_name"];   ?>
                                </td>

                                <td>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalStock" onclick="loadStock('<?php echo $product_id ?>');">
                                        <span class="glyphicon glyphicon-plus"></span>&nbsp; Add Stock
                                    </a>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#viewProduct" onclick="viewProduct('<?php echo $product_id ?>');">
                                        <span class="glyphicon glyphicon-plus"></span>&nbsp; View Product
                                    </a>
                                    <a href="../view/update-products.php?status=update_product&product_img=<?php echo $product_row["product_image"]; ?>&recode_id=<?php echo $product_id ?>&product_name=<?php echo $product_row["product_name"] ?>&brand_name=<?php echo $product_row["brand_name"] ?>&product_price=<?php echo $product_row["product_price"]; ?>&cat_name=<?php echo $product_row["cat_name"]; ?>&unit_name=<?php echo $product_row["unit_name"] ?>&product_img=<?php echo $product_row["product_image"] ?>" class="btn btn-success">
                                        <span class="glyphicon glyphicon-plus"></span>&nbsp; update Stock
                                    </a>
                                    <?php
                                    if ($product_row["product_status"] == 1) {
                                    ?>
                                        <a href="../controller/product_controller.php?status=deactivate&recode_id=<?php echo $product_id ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp; Deactivate</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="../controller/product_controller.php?status=activate&recode_id=<?php echo $product_id ?>" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp; Activate</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>
    <div class="modal fade" id="modalStock" role="dialog">

        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="../controller/product_controller.php?status=add_stock" method="post">
                    <!-- Form actions -->

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> <span class="glyphicon glyphicon-plus"></span>&nbsp; Add Stock </h4>
                    </div>
                    <div class="modal-body">
                        <div id="stockcont">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Save
                        </button>

                        &nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- View product Modal -->
    <div class="modal fade" id="viewProduct" role="dialog">
        <!--to identify which modal should appear id -->
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="../controller/product_controller.php?status=view_product" method="post">
                    <!-- update category  -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon"></span> &nbsp; View Product </h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div id="dynamicviewproduct">

                            </div>

                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- Add stock Modal -->
    <div class="modal fade" id="modalBrand" role="dialog">
        <!--to identify which modal should appear id -->
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="../controller/product_controller.php?status=add_brand" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> &nbsp; Add Brand</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label> Brand Name </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="brand_name" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save">
                            </span>&nbsp; Save</button>
                        &nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>




</body>
<!--   include jquery -->

</html>