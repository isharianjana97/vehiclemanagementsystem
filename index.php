<?php
if(!empty($_SERVER["HTTPS"]) && ('on'==$_SERVER["HTTPS"]))  //check whether the servers HTTp is on or off
{
    
    $url="https://";  //if its on started as ....
    
}
else{
    $url="http://";
    
}
$hostname=$_SERVER["HTTP_HOST"];  // url get as the host name //facebook.com
$url=$url.$hostname;   //apend current url to the host name
?>
<script>window.location="<?php echo $url."/bit_vehicle_manage/view/login.php"   ?>"</script>  send user to the login.php 

