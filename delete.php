<?php
require_once "connect.php";
$type = $_POST["type"];
$errorcheck = false;
if($type == "delete")
{
$sql = "SELECT * FROM books WHERE accessid=";
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

			<td class='deldata'>
			".$row['accessid']."
			</td>
			<td >
			".$row['author']."
			</td>
			<td >
			".$row['title']."
			</td>
			<td >
			".$row['volume']."
			</td>
			<td >
			".$row['publisher']."
			</td>
			<td >
			".$row['yop']."
			</td>
			<td >
			".$row['pages']."
			</td>
			<td >
			".$row['source']."
			</td>
			<td >
			".$row['classno']."
			</td>
			<td >
			".$row['bookno']."
			</td>
			<td >
			".$row['cost']."
			</td>
			<td >
			".$row['billno']."
			</td>
			<td >
			".$row['withdrawn']."
			</td>
			<td >
			".$row['entrydate']."
			</td>
			<td >
			".$row['DDCNO']."
			</td>
			<td >
			".$row['remarks']."
			</td>
			<td >
			".$row['almirah']."
			</td>
			<td >
			".$row['registerpage']."
			</td>
			<td >
			".$row['subject']."
			</td>
			<td >
			".$row['type']."
			</td>
			<td >
			".$row['lang']."
			</td>
			<td >
			".$row['tag']."
			</td>

		</tr>
			
				";

	
	}
}
}
if($type == "confirmdel")
{
    $data = $_POST['data'];
    foreach($data as $key){
    $sql = "DELETE FROM books WHERE accessid='".$key."'";
    mysqli_query($conn,$sql);
    if(!empty(mysqli_error($conn)))
    {
        echo mysqli_error($conn);
        $errorcheck = true;
    break;
    }
    
    }
    if(!$errorcheck)
    {
        echo "Deleted successfully";
    }
}
?>