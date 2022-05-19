<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray = $_SESSION["user_module"];

include_once '../model/vehicle_model.php';
$vehicleObj = new Vehicle();

$vehicle_id = $_GET["user_id"];
$return_msg = $_GET["msg"];

$paginationNumber = $_GET["pagination_number"];
if ($paginationNumber == "") {
    $paginationNumber = 0;
    $timesResult = $vehicleObj->getVehicleAllFunction($vehicle_id);
} else {
    $paginationNumber = (int)$paginationNumber;
    $timesResult = $vehicleObj->getVehiclePaginationFunction($paginationNumber);
}

$vehicle_id = base64_decode($vehicle_id);

echo $paginationNumber;


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
    <?php
    echo $return_msg;
    ?>
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
                <h4 align="center"> Human Resource Management </h4>
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
                    <?php include_once '../includes/servicescheduling-navigation.php'; ?>
                    <div class="col-md-4">
                        <a href="./generated_attendance_report.php?status=save" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save"></span> &nbsp;
                            Save Sales Report
                        </a>
                    </div>





            </div>
            <div class="col-md-9">
                <div class="tableFixHead" style="overflow: auto;">
                    <div style="width: 200%;">
                        <table class="table table-striped" style="border: 1px solid;">
                            <thead>
                                <tr style="background-color: #1796bd;color: #FFF ">
                                    <th> &nbsp; </th>
                                    <th> Id </th>
                                    <th style="width:100px;"> Vehicle Id </th>
                                    <th style="width:100px;"> Vehicle name </th>
                                    <th> Vehicle issue </th>
                                    <th style="width:200px;"> Customer Name </th>
                                    <th style="width:150px;"> Arrived on </th>
                                    <th style="width:150px;"> Delivered on</th>
                                    <th> Charge </th>
                                    <th> status </th>
                                    <th> &nbsp; </th>
                                    <th> &nbsp; </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userImage = "defaultImage.jpg";
                                while ($user_row = $timesResult->fetch_assoc()) {
                                    $vehicle_id =  base64_encode($user_row["userId"]);
                                    $recode_id = $user_row["id"];
                                    // echo $user_row["id"];

                                    // if ($user_row["user_image"] == "") {
                                    // } else {
                                    //     $userImage = $user_row["user_image"];
                                    // }

                                ?>

                                    <tr>

                                        <td><?php echo $user_row["id"];  ?></td>
                                        <td>
                                            <img src="<?php echo "../controller/uploads/" . $user_row['vehicle_image'] ?> " width="60" height="80px" />
                                        </td>
                                        <td><?php echo $user_row["vehicle_id"];  ?></td>
                                        <td><?php echo $user_row["vehicle_name"];  ?></td>
                                        <td><?php echo $user_row["vehicle_issue"];  ?></td>
                                        <td><?php echo $user_row["customer_name"];  ?></td>
                                        <td class="arrival-time"><?php echo $user_row["arrived_on"];  ?></td>
                                        <td class="arrival-time"><?php echo $user_row["delivered_on"];  ?></td>
                                        <td><?php echo $user_row["task_charge"];  ?></td>
                                        <td>
                                            <?php
                                            if ($user_row["status"] == "0") {   
                                            ?>
                                                <a href="../controller/vehicle_controller.php?status=finish&vehicle_id=<?php echo $user_row["vehicle_id"] ?>&recode_id=<?php echo $user_row["id"] ?>&field_name=<?php echo "status" ?>&data=<?php echo "1" ?>&pagination_number=<?php echo $paginationNumber ?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>&nbsp; Set As finished</a>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-success" disabled><span class="glyphicon glyphicon-ok"></span>&nbsp; Finished</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="../view/updatedeal.php?status=update&vehicle_id=<?php echo $user_row["vehicle_id"] ?>&vehicle_name=<?php echo $user_row["vehicle_name"] ?>&vehicle_issue=<?php echo $user_row["vehicle_issue"] ?>&customer_name=<?php echo $user_row["customer_name"] ?>&arrived_on=<?php echo $user_row["arrived_on"] ?>&delivered_on=<?php echo $user_row["delivered_on"] ?>&task_charge=<?php echo $user_row["task_charge"] ?>&vehicle_image=<?php echo $user_row["vehicle_image"] ?>&recode_id=<?php echo $user_row["id"] ?>&pagination_number=<?php echo $paginationNumber ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Update</a>
                                        </td>
                                        <td>
                                            <a href="../controller/vehicle_controller.php?status=delete&vehicle_id=<?php echo $user_row["vehicle_id"] ?>&recode_id=<?php echo $user_row["id"] ?>&pagination_number=<?php echo $paginationNumber ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Delete</a>
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
                                    <li class="page-item"><a class="page-link" href="../view/serviceschedule.php?pagination_number=<?php echo $paginationNumber - 1 ?>">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="../view/serviceschedule.php?pagination_number=<?php echo $paginationNumber ?>"><?php echo $paginationNumber + 1 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/serviceschedule.php?pagination_number=<?php echo $paginationNumber + 1 ?>"><?php echo $paginationNumber + 2 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/serviceschedule.php?pagination_number=<?php echo $paginationNumber + 2 ?>"><?php echo $paginationNumber + 3 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/serviceschedule.php?pagination_number=<?php echo $paginationNumber + 3 ?>">Next</a></li>
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