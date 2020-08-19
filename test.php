<?php
require_once "connect.php";
/*
$date1=date('Y-m-d');
$date2 = "2020-07-18";
if(strtotime($date1) <= strtotime($date2))
{
    echo "g";
}
else{
    echo "np";
}
var_dump($_POST["data"]);

function getaccessid($data)
{
	if($data = "End")
		{
		$sql1 = "SELECT * FROM books ORDER BY accessid DESC LIMIT 1";
			$row = mysqli_query($GLOBALS['conn'],$sql1);
			$res = mysqli_fetch_assoc($row);
			return @$res['accessid'];
		}
}
*/
$sql1 = "SELECT accessid FROM books WHERE accessid BETWEEN 0 AND 10000000";
$row = mysqli_query($conn,$sql1);
$a ="";
$i=0;
while($res = mysqli_fetch_assoc($row))
{
	$a=$a.$res["accessid"].",";
}
print($a);
print_r()
?>