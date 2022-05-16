<?php
//  include the connection
echo "bbbbbbbbbbbbbbb";
include_once '../commons/dbConnection.php';
$dbconnection= new dbConnection();

class Login
{
    public function checkUserExistence($username,$password)
    {
        $conn= $GLOBALS["conn"];
        
        $sql="SELECT u.user_id FROM user u, login l "
                . "WHERE u.user_id=l.user_id AND "
                . "l.login_username='$username' AND "
                . "l.login_password='$password' AND "
                . "u.user_status='1'";
            $result =$conn->query($sql) or die($conn->error);
            $row= $result->fetch_assoc();   //convert to associative array
            return $row["user_id"];
    }
}