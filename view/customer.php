<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray = $_SESSION["user_module"];

include_once '../model/customer_model.php';
$customerObj = new Customer();
$customer_id = $_GET["user_id"];
$return_msg = $_GET["msg"];
if (isset($_GET["msg"])) {
    $return_msg = $_GET["msg"];
} else {
    $return_msg = "";
}
if ($return_msg != "") {
    $return_msg = base64_decode($return_msg);
}

$paginationNumber = $_GET["pagination_number"];
if ($paginationNumber == "") {
    $paginationNumber = 0;
    $timesResult = $customerObj->getCustomers();
} else {
    $paginationNumber = (int)$paginationNumber;
    $timesResult = $customerObj->getCustomerPaginationFunction($paginationNumber);
}

$customer_id = base64_decode($customer_id);

?>
<html>

<head>
    <!--  include bootstrap css   -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />

    <style>
        .tableFixHead {
            overflow: auto;
            height: 400px;
        }

        .tableFixHead thead th {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px 16px;
            font-size: 12px;
        }

        th {
            background: #947;
        }
    </style>

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
            <div class="col-md-2"><span class="glyphicon glyphicon-user"></span>
                &nbsp;
                <?php
                echo ucwords($_SESSION["user"]["user_fname"] . " " . $_SESSION["user"]["user_lname"]);
                ?>
            </div>
            <div class="col-md-8">
                <h4 align="center"> Customer Management </h4>
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
                    <li> <a href="../view/dashboard.php">Dashboard</a></li>
                </ul>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <?php include_once '../includes/customer-navigation.php'; ?>
                    <div class="col-md-4">
                        <a href="./generated_customer_report.php?status=save" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save"></span> &nbsp;
                            Save customer Report
                        </a>
                    </div>





            </div>
            <div class="col-md-9">
                <div class="tableFixHead" style="overflow: auto;">
                    <div style="width: 100%;">
                        <table class="table table-striped" style="border: 1px solid;">
                            <thead>
                                <tr style="background-color: #1796bd;color: #FFF ">
                                    <th style="width:30px;"> Id </th>
                                    <th style="width:50px;"> Customer name </th>
                                    <th style="width:100px;"> Customer Email </th>
                                    <th style="width:150px;"> Customer contact </th>
                                    <th style="width:100px;"> &nbsp; </th>
                                    <th style="width:100px;"> &nbsp; </th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userImage = "defaultImage.jpg";
                                while ($user_row = $timesResult->fetch_assoc()) {
                                    // $customer_id =  base64_encode($user_row["userId"]);
                                    $recode_id = $user_row["id"];
                                    // echo $user_row["id"];

                                    // if ($user_row["user_image"] == "") {
                                    // } else {
                                    //     $userImage = $user_row["user_image"];
                                    // }

                                ?>

                                    <tr>
                                        <td><?php echo $user_row["customer_id"];  ?></td>
                                        <td><?php echo $user_row["customer_fname"]. " ". $user_row["customer_lname"];  ?></td>
                                        <td><?php echo $user_row["customer_email"];  ?></td>
                                        <td><?php echo $user_row["customer_contact"];  ?></td>

                                        <td>
                                            <a href="../view/update-customer.php?status=update&customer_id=<?php echo $user_row["customer_id"] ?>&customer_contact=<?php echo $user_row["customer_contact"] ?>&customer_email=<?php echo $user_row["customer_email"] ?>&customer_fname=<?php echo $user_row["customer_fname"]?>&customer_lname=<?php echo $user_row["customer_lname"] ?>&pagination_number=<?php echo $paginationNumber ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Update</a>
                                        </td>
                                        <td>
                                            <a href="../controller/customer_controller.php?status=delete&customer_id=<?php echo $user_row["customer_id"] ?>&recode_id=<?php echo $user_row["id"] ?>&pagination_number=<?php echo $paginationNumber ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Delete</a>
                                        </td>

                                    </tr>
                                <?php
                                }

                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="row col-md-12">

                    <!--   Enter first name and the last name -->
                    <div class="row">
                        <div class="col-md-8" style="margin-right:0; padding-top:38px; padding-right:0;">
                        </div>
                        <div class="col-md-4" style="margin-right:0; padding-top:8px; padding-right:0;">

                            <nav aria-label="Page float-right navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="../view/customer.php?pagination_number=<?php echo $paginationNumber - 1 ?>">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="../view/customer.php?pagination_number=<?php echo $paginationNumber ?>"><?php echo $paginationNumber + 1 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/customer.php?pagination_number=<?php echo $paginationNumber + 1 ?>"><?php echo $paginationNumber + 2 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/customer.php?pagination_number=<?php echo $paginationNumber + 2 ?>"><?php echo $paginationNumber + 3 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/customer.php?pagination_number=<?php echo $paginationNumber + 3 ?>">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- <form class="row" action="../controller/user_controller.php?status=arrive&pagination_number=<?php echo $paginationNumber ?>" method="post" style="margin-left:0; padding-top:8px; padding-right:0;">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" name="userId" id="userId" class="form-control" placeholder="userId" />
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="arrivalDate" id="arrivalDate" class="form-control" placeholder="Arrival Date" />
                            </div>
                            <div class="col-md-3">
                                <input type="time" name="arrivalTime" id="arrivalTime" class="form-control" placeholder="Arrival time" />
                            </div>
                            <div class="col-md-1">
                                <button type="button" onclick=setNow() class="btn btn-info">set to now</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success">Arrived now</button>
                            </div>
                        </div>


                    </form> -->

                </div>
            </div>
        </div>


    </div>
</body>
<!--   include jquery -->
<script src="../js/jquery-1.12.4.js"></script>

<script src="../js/loginvalidation.js"></script>
<!-- include bootstrap js -->
<script src="../bootstrap/js/bootstrap.min.js"></script>

<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
</style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
    function setNow() {
        var date = new Date();

        var day = date.getDate(),
            month = date.getMonth(),
            year = date.getFullYear(),
            hour = date.getHours(),
            min = date.getMinutes();

        month = (month < 10 ? "0" : "") + month;
        day = (day < 10 ? "0" : "") + day;
        hour = (hour < 10 ? "0" : "") + hour;
        min = (min < 10 ? "0" : "") + min;

        var today = year + "-" + month + "-" + day,
            displayTime = hour + ":" + min;

        document.getElementById('arrivalDate').valueAsDate = new Date();
        document.getElementById('arrivalTime').value = displayTime;
    }

    let timeText = $(".arrival-time");
    console.log(timeText[0])
    for (let i = 0; i < timeText.length; i++) {
        let ele = timeText[i];
        let timeTextcurr = ele.innerText.trim();
        let result = timeTextcurr.substring(0, 19);
        ele.innerText = result;
    }

    timeText = $(".off-time");
    console.log(timeText[0])
    for (let i = 0; i < timeText.length; i++) {
        let ele = timeText[i];
        let timeTextcurr = ele.innerText.trim();
        if (timeTextcurr == "Leave Now")
            continue;
        let result = timeTextcurr.substring(0, 19);
        ele.innerText = result;
    }


    function updateDetails(id, paginationNumber) {
        window.location = `../view/serviceschedule.php?update_id=${id}&pagination_number=${paginationNumber}`;
    }

    // timeText.forEach((ele) => {
    //     let timeTextcurr = ele.text().trim();
    //     let result = timeTextcurr.substring(0, 19);
    //     ele.text(result);
    // })
    // $( ".arrival-time" ).text(result);

    // timeText = $( ".off-time" ).text().trim();
    // console.log(timeText)
    // result = timeText.substring(0, 19);
    // $( ".off-time" ).text(result);
</script>

</html>