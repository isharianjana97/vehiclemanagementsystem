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





        .imagePreview {
            width: 100%;
            height: 180px;
            background-position: center center;
            background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
        }

        .imgUp .btn-primary {
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;
        }

        .imgUp {
            margin-bottom: 15px;
            width: 230px !important;
        }

        .del {
            position: absolute;
            top: 0px;
            right: 15px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            background-color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
        }

        .imgAdd {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #4bd7ef;
            color: #fff;
            box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
            text-align: center;
            line-height: 30px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
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

                <form action="../controller/vehicle_controller.php?status=add_deal" method="post" enctype="multipart/form-data">
                    <h2>Add New Deal</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first">Vehicle Identifier</label>
                                <input type="text" class="form-control" placeholder="" id="vid" name="vid">
                            </div>
                        </div>
                        <!--  col-md-6   -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last">Vehicle Name</label>
                                <input type="text" class="form-control" placeholder="" id="vname" name="vname">
                            </div>
                        </div>
                        <!--  col-md-6   -->
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company">Customer Name</label>
                                <input type="text" class="form-control" placeholder="" name="customername" id="customername">
                            </div>


                        </div>
                        <!--  col-md-6   -->

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="phone">Arrival Date and time</label>

                                <div class="row">

                                    <div class="col-md-5">
                                        <input type="date" name="arrivalDate" id="arrivalDate" class="form-control" placeholder="Arrival Date" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="time" name="arrivalTime" id="arrivalTime" class="form-control" placeholder="Arrival time" />
                                    </div>
                                    <div class="col-md-1" style="left:-10px;">
                                        <button type="button" onclick=setNow() class="btn btn-info">set to now</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--  col-md-6   -->
                    </div>
                    <!--  row   -->


                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="phone">Delivery Date and time</label>

                                <div class="row">

                                    <div class="col-md-5">
                                        <input type="date" name="deliverydate" id="deliverydate" class="form-control" placeholder="Delivery Date" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="time" name="deliverytime" id="deliverytime" class="form-control" placeholder="Delivery time" />
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!--  col-md-6   -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url">Task Charges</label>
                                <input type="text" class="form-control" placeholder="in LKR" id="charge" name="charge">
                            </div>

                        </div>
                        <!--  col-md-6   -->

                        <div class="col-md-12">
                            <label for="exampleFormControlTextarea1">Vehicle issue</label>
                            <textarea class="form-control" name="issue" id="exampleFormControlTextarea1" rows="3" style="resize: vertical;"></textarea>
                        </div>

                    </div>
                    <!--  row   -->


                    <br>
                    <div class="container-all">
                        <div class="row">
                            <div class="col-sm-2 imgUp">
                                <div class="imagePreview"></div>
                                <label class="btn btn-primary">
                                    Vehicle Image Upload<input type="file" class="uploadFile img" name="photo" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                </label>
                            </div><!-- col-2 -->
                            <i class="fa fa-plus imgAdd"></i>
                        </div><!-- row -->
                    </div><!-- container -->




                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

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


    $(".imgAdd").click(function() {
        $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
    });
    $(document).on("click", "i.del", function() {
        $(this).parent().remove();
    });
    $(function() {
        $(document).on("change", ".uploadFile", function() {
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function() { // set image data as background of div
                    //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                    uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                }
            }

        });
    });

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