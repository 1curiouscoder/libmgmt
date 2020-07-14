<?php
require_once "connect.php";
$type = @$_POST['type'];
if($type=="update")
{
$arr = array("accessid","author","title","volume","publisher","yop",'pages',"source","classno","bookno","cost","billno","withdrawn","entrydate","DDCNO","remarks");
foreach($_POST["data"] as $key) 
	{
	# code...
	$sql = "UPDATE books SET ";
	for($i=0;$i<15;$i++) 
		{
			# code...
			$sql=$sql.$arr[$i]."=".$key[$i];
		}
		echo $sql."()";	
	}
}
else
{

$sql = "SELECT * FROM books WHERE accessid=";
echo $sql;
foreach ($_POST['data'] as $key) {
	# code...
$res = mysqli_query($conn,$sql."'".$key."'");
if(!empty(mysqli_error($conn)))
{
	echo mysqli_error($conn);
	break;
}
else
	{
$row = mysqli_fetch_assoc($res);
		echo "


		<tr>

			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['accessid']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['author']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['title']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['volume']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['publisher']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['yop']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['pages']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['source']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['classno']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['bookno']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['cost']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['billno']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['withdrawn']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['entrydate']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['DDCNO']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['remarks']."'>
			</td>

		</tr>
			
				";

	
	}
}
}
?>