<?php
require_once "connect.php";
function checkpost($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = str_replace("'", "''", $data);
	//$data = str_replace('"', '""', $data);
	return $data;
}
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
function getallAccessid()
{
$sql1 = "SELECT accessid FROM books";
$row = mysqli_query($GLOBALS['conn'],$sql1);
$a =[];
$i=0;
while($res = mysqli_fetch_assoc($row))
{
$a[$i]=($res['accessid']);
$i+=1;
}
return($a);
}
?>