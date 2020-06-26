<?php
require_once "connect.php";
//$data = $_POST['query'];
if(1)
{
	if(1)
	{
		$sql = "SELECT * FROM books ORDER BY accessid DESC LIMIT 1";
		$row = mysqli_query($conn,$sql);
		while($res = mysqli_fetch_assoc($row)){
				echo $res['accessid'];
			}
	}
}
?>