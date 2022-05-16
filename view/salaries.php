<?php
include '../commons/sessions.php';

///  getting user module information
$moduleArray = $_SESSION["user_module"];

include_once '../model/user_model.php';
$userObj = new User();

$user_id = $_GET["user_id"];
$return_msg = $_GET["msg"];

$paginationNumber = $_GET["pagination_number"];
if ($paginationNumber == ""){
    $paginationNumber = 0;
    $timesResult = $userObj->getUserSalariesFunctionAll($user_id);
}else{
    $paginationNumber = (int)$paginationNumber;
    $timesResult = $userObj->getUserSalariesPaginationFunction($paginationNumber);
}

$user_id = base64_decode($user_id);

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
        }

        th {
            background: #55f;
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
                    <?php include_once '../includes/hr-navigation.php'; ?>
                    <div class="col-md-4">    
                            <a href="./generated_salary_report.php?status=save" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-save"></span> &nbsp;
                                Save Salary Report
                            </a>
                        </div> 
                    
                    <div>
                        <?php include_once '../includes/Simplecalculator.php'; ?>
                    </div>
            </div>
            <div class="col-md-9">
                <div class="tableFixHead">

                    <table class="table table-striped" style="border: 1px solid;">
                        <thead>
                            <tr style="background-color: #1796bd;color: #FFF ">
                                <th> Id </th>
                                <th> &nbsp; </th>
                                <th> User Id </th>
                                <th> User Name </th>
                                <th> paid on </th>
                                <th> Amount paid </th>
                                <th> &nbsp; </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $userImage = "defaultImage.jpg";
                            while ($user_row = $timesResult->fetch_assoc()) {
                                $user_id =  base64_encode($user_row["userId"]);
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
                                        <img src="../images/user_images/<?php echo $user_row["profile_img"] ?> " width="60" height="80px" />
                                    </td>
                                    <td><?php echo $user_row["user_id"];  ?></td>
                                    <td><?php echo ucwords($user_row["user_fname"] . " " . $user_row["user_lname"]) ?></td>
                                    <td class="arrival-time"><?php echo $user_row["payDate"];  ?></td>
                                    <td class="off-time"> <?php echo $user_row["amount"] ?>
                                    </td>

                                </tr>
                            <?php
                            }

                            ?>

                        </tbody>

                    </table>
                </div>

                <div class="row col-md-12">

                    <!--   Enter first name and the last name -->
                    <div class="row">
                        <div class="col-md-8" style="margin-right:0; padding-top:38px; padding-right:0;">
                            <label class="control-label"> User Attendance </label>
                        </div>
                        <div class="col-md-4" style="margin-right:0; padding-top:8px; padding-right:0;">

                            <nav aria-label="Page float-right navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="../view/salaries.php?pagination_number=<?php echo $paginationNumber-1 ?>">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="../view/salaries.php?pagination_number=<?php echo $paginationNumber ?>"><?php echo $paginationNumber+1 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/salaries.php?pagination_number=<?php echo $paginationNumber+1 ?>"><?php echo $paginationNumber+2 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/salaries.php?pagination_number=<?php echo $paginationNumber+2 ?>"><?php echo $paginationNumber+3 ?></a></li>
                                    <li class="page-item"><a class="page-link" href="../view/salaries.php?pagination_number=<?php echo $paginationNumber+3 ?>">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <form class="row" action="../controller/user_controller.php?status=payment&pagination_number=<?php echo $paginationNumber ?>" method="post" style="margin-left:0; padding-top:8px; padding-right:0;">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" name="userId" id="userId" class="form-control" placeholder="userId" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount in LKR" />
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
                                <button type="submit" class="btn btn-success">pay now</button>
                            </div>
                        </div>


                    </form>

                    

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
            month = date.getMonth() + 1,
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

    let timeText = $( ".arrival-time" );
    console.log(timeText[0])
    for (let i=0;i<timeText.length;i++){
        let ele = timeText[i];
        let timeTextcurr = ele.innerText.trim();
        let result = timeTextcurr.substring(0, 19);
        ele.innerText = result;
    }

    timeText = $( ".off-time" );
    console.log(timeText[0])
    for (let i=0;i<timeText.length;i++){
        let ele = timeText[i];
        let timeTextcurr = ele.innerText.trim();
        if (timeTextcurr == "Leave Now")
            continue;
        let result = timeTextcurr.substring(0, 19);
        ele.innerText = result;
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