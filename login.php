<?php
require_once "connect.php";

$uname = $_POST['uname'];
$pass = $_POST['pass'];


$sql = "SELECT uname, pass FROM user WHERE uname='$uname'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
$row = mysqli_fetch_assoc($result);

if($uname==$row['uname'] && $pass == $row['pass'])
{
	header("location:html/dashboard.html");
}
else
{
	header("location:html/index.html");
}

}
	?>