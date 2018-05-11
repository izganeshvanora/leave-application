<?php
require('connect.php');

$uname=$_GET["Username"];
$psw=$_GET["Password"];

$sql = "SELECT * FROM login where emp_name='$uname' and password='$psw'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$emp=$row["slno_empid"];
    	header("Location:checkin.php?user=$emp");
    }
} else {
   header("Location:index.html");
}

?>