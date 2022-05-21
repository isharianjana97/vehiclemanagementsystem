<?php
include '../commons/sessions.php';

///  getting user module information

include '../model/user_model.php';
$userObj = new User();
//   getting all users

$userResult = $userObj->getAllUsers();

$moduleArray = $_SESSION["user_module"];
?>
<html>

<head>
    <!--  include bootstrap css   -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
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
                <h4 align="center"> View Users </h4>
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
                include_once '../includes/user-navigation.php';
                ?>

            </div>
            <div class="col-md-9">
                <table class="table table-striped">
                    <thead>
                        <tr style="background-color: #1796bd;color: #FFF ">
                            <th> &nbsp; </th>
                            <th> Name </th>
                            <th> NIC </th>
                            <th> User Role</th>
                            <th> Status </th>
                            <th> &nbsp; </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($user_row = $userResult->fetch_assoc()) {
                            $user_id =  base64_encode($user_row["user_id"]);

                            if ($user_row["user_image"] == "") {
                                $userImage = "defaultImage.jpg";
                            } else {
                                $userImage = $user_row["user_image"];
                            }


                        ?>


                            <tr>
                                <td>
                                    <img src="../controller/uploads/<?php echo $userImage ?> " width="60" height="80px" />
                                </td>
                                <td><?php echo ucwords($user_row["user_fname"] . " " . $user_row["user_lname"]);    ?></td>
                                <td><?php echo $user_row["user_nic"];  ?></td>
                                <td><?php echo $user_row["role_name"];  ?></td>
                                <td>
                                    <?php
                                    if ($user_row["user_status"] == 1) {
                                    ?>
                                        <label class="label label-success">Active</label>
                                    <?php
                                    } else {
                                    ?>
                                        <label class="label label-danger">Deactive</label>
                                    <?php
                                    }
                                    ?>
                                </td>

                                <td>
                                    <a href="view-user.php?user_id=<?php echo $user_id; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span>&nbsp;View</a>


                                    <?php
                                    if ($user_row["user_status"] == 1) {
                                    ?>


                                        <a href="../controller/user_controller.php?status=deactivate&user_id=<?php echo $user_id ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp; Deactivate</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="../controller/user_controller.php?status=activate&user_id=<?php echo $user_id ?>" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp; Activate</a>


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
</body>
<!--   include jquery -->
<script src="../js/datatable/jquery-3.5.1.js"></script>
<script src="../js/datatable/jquery.dataTables.min.js"></script>
<!-- include bootstrap js -->
<script src="../js/datatable/dataTables.bootstrap.min.js"></script>

<!-- when data stored make the user table in to data table-->
<script>
    $(document).ready(function() {
        $("#usertable").DataTable();
    });
</script>

</html>
