<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray = $_SESSION["user_module"];

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
                <h4 align="center"> <?php echo ucwords($_SESSION["user"]["role_name"]); ?> Panel</h4>
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
            <?php
            foreach ($moduleArray as $mod) {

            ?>
                <a href="<?php echo $mod["module_url"]; ?>?pagination_number=0&msg=&user_id=0">
                    <div class="col-md-3">
                        <div class="panel" style="height: 200px;background-color: #e8aa90">
                            <h4>
                                <?php
                                echo ucwords($mod["module_name"])
                                ?>
                            </h4>
                            <img src="../images/iconset/<?php echo $mod["module_image"]; ?>" width="150px" height="150px" style="margin-left:50px " />
                        </div>

                    </div>
                </a>
            <?php
            } ?>
        </div>
    </div>
</body>
<!--   include jquery -->
<script src="../js/jquery-1.12.4.js"></script>

<script src="../js/loginvalidation.js"></script>
<!-- include bootstrap js -->
<script src="../bootstrap/js/bootstrap.min.js"></script>

</html>