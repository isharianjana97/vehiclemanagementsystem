<?php

include_once '../commons/dbConnection.php';
$dbconnection = new dbConnection();


class Customer
{


    public function addNewDeal($vid, $vname, $customername, $arrivalDate, $arrivalTime, $deliverydate, $deliverytime, $charge, $issue, $photo)
    {
        echo $vid. "<br>". $vname. "<br>". $customername. "<br>". $arrivalDate. "<br>". $arrivalTime. "<br>". $deliverydate. "<br>". $deliverytime. "<br>". $charge. "<br>". $issue. "<br>". $photo;

        $conn = $GLOBALS["conn"];
        try {
            $sql = "INSERT INTO customer_management_db.customer_service
            (
            customer_id,
            customer_name,
            customer_issue,
            customer_name,
            arrived_on,
            delivered_on,
            task_charge,
            customer_image)
            VALUES
            (
                '$vid', 
                '$vname', 
                '$issue', 
                '$customername', 
                '$arrivalDate $arrivalTime', 
                '$deliverydate $deliverytime', 
                '$charge', 
                '$photo' 
            )";
        } catch (Exception $e) {

            echo $e;
        }

        $result = $conn->query($sql);
        return $result;
    }

    public function modifyDeal($vid, $vname, $customername, $arrivalDate, $arrivalTime, $deliverydate, $deliverytime, $charge, $issue, $photo, $recode_id)
    {
        echo $vid. "<br>". $vname. "<br>". $customername. "<br>". $arrivalDate. "<br>". $arrivalTime. "<br>". $deliverydate. "<br>". $deliverytime. "<br>". $charge. "<br>". $issue. "<br>". $photo. "<br>". $recode_id. "<br>";

        $conn = $GLOBALS["conn"];
        try {
            $sql = "UPDATE customer_management_db.customer_service 
                    SET 
                        customer_id = '$vid',
                        customer_name = '$vname',
                        customer_issue = '$issue',
                        customer_name = '$customername',
                        arrived_on = '$arrivalDate $arrivalTime',
                        delivered_on = '$deliverydate $deliverytime',
                        task_charge = '$charge', 
                        customer_image = '$photo'
                    WHERE
                        id = '$recode_id'";


        } catch (Exception $e) {

            echo $e;
        }

        $result = $conn->query($sql);
        return $result;
    }

    public function getCustomers()
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM customer_management_db.customer";
        $result = $conn->query($sql);
        return $result;
    }
    public function getUserRoles() //
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM role";
        $result = $conn->query($sql);
        return $result;
    }

    public function getModulesByRole($role_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM module_role mr , module m WHERE mr.module_id=m.module_id AND mr.role_id='$role_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function getModuleFunctions($module_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM function WHERE module_id='$module_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function addUser($user_fname, $user_lname, $user_email, $user_gender, $user_nic, $user_cno1, $user_cno2, $user_image, $user_role)
    {
        $conn = $GLOBALS["conn"];
        $sql = "INSERT INTO user(user_fname,
                                user_lname,
                                user_email,
                                user_gender,
                                user_nic,
                                user_cno1,
                                user_cno2,
                               user_image,
                               user_role)
                             VALUES(
                            '$user_fname','$user_lname','$user_email','$user_gender',"
            . "'$user_nic','$user_cno1','$user_cno2','$user_image','$user_role')";
        $result = $conn->query($sql) or die($conn->error);

        $user_id = $conn->insert_id; //insrted user id
        return $user_id;
    }


    public function addUserFunction($user_id, $function_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "INSERT INTO user_function(user_id,function_id)VALUES('$user_id','$function_id')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function getAllCustomers()
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM vehicle_management_db.customer";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    
    public function getSpecificUser($user_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM user u, role r WHERE u.user_role= r.role_id AND u.user_id='$user_id'"; //particular user's info
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function  addUserLogin($user_id, $username, $nic)
    {
        $pw =  sha1($nic);
        $conn = $GLOBALS["conn"];
        $sql = "INSERT INTO login(login_username,login_password,user_id)VALUES('$username','$pw','$user_id')";
        $result = $conn->query($sql) or die($conn->error);
    }

    public function activateUser($user_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "UPDATE user SET user_status=1 WHERE user_id='$user_id'";
        $result = $conn->query($sql) or die($conn->error);
    }

    public function deactivateUser($user_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "UPDATE user SET user_status=0 WHERE user_id='$user_id'";
        $result = $conn->query($sql) or die($conn->error);
    }


    public function modifyCustomer(
        $customer_ids, $customer_fname, $customer_lname, $customer_email, $customer_contact
    ) {
        $conn = $GLOBALS["conn"];
        $sql = "UPDATE `vehicle_management_db`.`customer`
                SET
                `customer_fname` = '$customer_fname',
                `customer_lname` = '$customer_lname',
                `customer_email` = '$customer_email',
                `customer_contact` = '$customer_contact'
                WHERE `customer_id` = '$customer_ids'";

        $result = $conn->query($sql) or die($conn->error) or die($conn->error);
        return $result;
    }

    public function addCustomer($customer_fname, $customer_lname, $customer_email, $customer_contact) {
        $conn = $GLOBALS["conn"];
        $sql = "INSERT INTO `vehicle_management_db`.`customer`
        (`customer_fname`,
        `customer_lname`,
        `customer_email`,
        `customer_contact`)
        VALUES
        ('$customer_fname',
        '$customer_lname',
        '$customer_email',
        '$customer_contact')";

        $result = $conn->query($sql) or die($conn->error) or die($conn->error);
        return $result;
    }

    public function removecustomerRecodeFunctions($customer_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "DELETE FROM customer WHERE customer_id='$customer_id'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function finishDealOfAcustomer($customer_id,$field_name,$data)
    {
        $conn = $GLOBALS["conn"];
        $sql = "UPDATE customer_service SET $field_name='$data' where id = '$customer_id'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function getUserAssignedFunctions($user_id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM user_function WHERE user_id='$user_id'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getUserTimeTablesFunctionAll()
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM (SELECT DISTINCT * FROM user_time_table, user WHERE user_time_table.userId = user.user_id  GROUP BY userId) sub ORDER BY id DESC";

        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getUserSalariesFunctionAll()
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM (SELECT DISTINCT * FROM user_salary, user WHERE user_salary.userId = user.user_id ) sub ORDER BY id DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getcustomerAllFunction()
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM customer_service ORDER BY id DESC LIMIT 15,5";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getUserTimeTablesFunctionSpecificUser($userId, $givenTime)
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM (SELECT * FROM user_time_table, user WHERE user_time_table.userId = user.user_id AND user_time_table.arrival_time > '$givenTime' AND user_time_table.userId = '$userId') sub ORDER BY id DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function getCustomerPaginationFunction($paginationNumber)
    {
        $conn = $GLOBALS["conn"];
        $startAt = 5 * $paginationNumber;
        $sql = "SELECT * FROM customer ORDER BY customer_id DESC LIMIT $startAt,5";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getUserSalariesPaginationFunction($paginationNumber)
    {
        $conn = $GLOBALS["conn"];
        $startAt = 5 * $paginationNumber;
        $sql = "SELECT * FROM (SELECT * FROM user_salary, user WHERE user_salary.userId = user.user_id ORDER BY id DESC LIMIT $startAt,5) sub ORDER BY id DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function setArrivedUser($user_id, $arrivalDate, $arrivalTime)
    {
        $conn = $GLOBALS["conn"];
        $sql = "INSERT INTO user_time_table (userId,arrival_time) VALUES('$user_id','$arrivalDate $arrivalTime')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function setPaidUser($user_id, $amount, $arrivalDate, $arrivalTime)
    {
        $conn = $GLOBALS["conn"];
        $sql = "INSERT INTO user_salary (userId,payDate,amount) VALUES('$user_id','$arrivalDate $arrivalTime',$amount)";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function setLeaveUser($user_id, $id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "UPDATE user_time_table SET off_time = now() WHERE id='$id' AND userId='$user_id'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function getActiveUserCount()
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT COUNT(user_id) as activeUserCount FROM user  WHERE user_status='1'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function getDeactiveUser()
    {
        $conn = $GLOBALS["conn"];
        $sql = "SELECT * FROM user WHERE user_status='0'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}
