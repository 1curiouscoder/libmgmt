<?php
require_once "connect.php";
require_once "functions.php";

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;




$type = @$_POST['type'];
$errorcheck = false;
if($type=="update")
{
$arr = array("accessid","author","title","volume","publisher","yop","pages","source","classno","bookno","cost","billno","withdrawn","entrydate","DDCNO","remarks","almirah","registerpage","subject","type","lang","tag");
foreach($_POST["data"] as $key) 
	{
	# code...
		
	$sql = "UPDATE books SET ";
	for($i=0;$i<22;$i++) 
		{	$key[$i] = checkpost($key[$i]);
			if(empty(@$key[$i]))
			{
				$key[$i] = "";
			}
			# code...
			if($i==21)
			{
			$sql=$sql.$arr[$i]."='".$key[$i]."'";
			break; 	
			}
			$sql=$sql.$arr[$i]."='".$key[$i]."',";
		}
		$sql=$sql."WHERE accessid='".$key[0]."'";
		//echo $sql;
		mysqli_query($conn,$sql);
		if(!empty(mysqli_error($conn)))	
		{
			echo mysqli_error($conn);
			break;
			$errorcheck=true;
		}

	}
	if(!$errorcheck)
	{
		echo "Updation complete";
	}
}
elseif ($type == "fileupd") {
	# code...


$sql = "UPDATE books SET ";


require 'vendor/autoload.php';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$files=$_FILES['fileupload'];
$tmp_name=$files['tmp_name'];
$name=$files['name'];
$destination=$name;
$spreadsheet = $reader->load($tmp_name);

$dataArray = $spreadsheet->getActiveSheet()
    ->rangeToArray(	
        'A1:Z20000',     // The workshet range that we want to retrieve
        NULL,        // Value that should be returned for empty cells
        TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
        TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
        TRUE         // Should the array be indexed by cell row and cell column
    ); // this fetches values of the sheet and stores it in an arrya dataArray.
$i=2;
$table="";
$added_accnid = array("null"); // used to store accessionid that are added to sql query
while(!empty(checkpost($dataArray[$i]['A']))) //runs loop until encounters any empty accessionid cell 
{
	
	if(!in_array($dataArray[$i]['A'],$added_accnid))
	{	
	$sql=$sql.'accessid="'.$dataArray[$i]["A"].'",author=
	"'.$dataArray[$i]["B"].'",title="'.$dataArray[$i]['C'].'",volume="'.$dataArray[$i]['D'].'",publisher="'.$dataArray[$i]['E'].'",yop="'.$dataArray[$i]['F'].'",pages="'.$dataArray[$i]['G'].'",source="'.$dataArray[$i]['H'].'",classno="'.$dataArray[$i]['I'].'",bookno="'.$dataArray[$i]['J'].'",cost="'.$dataArray[$i]['K'].'",billno="'.$dataArray[$i]['L'].'",withdrawn="'.$dataArray[$i]['M'].'",entrydate="'.$dataArray[$i]['N'].'",DDCNO="'.$dataArray[$i]['O'].'",remarks="'.$dataArray[$i]['P'].'",almirah="'.$dataArray[$i]['Q'].'",registerpage="'.$dataArray[$i]['R'].'",subject="'.$dataArray[$i]['S'].'",type="'.$dataArray[$i]['T'].'",lang="'.$dataArray[$i]['U'].'",tag="'.$dataArray[$i]['V'].'" WHERE accessid="'.$dataArray[$i]["A"].'"';

	mysqli_query($conn,$sql);
	if(!empty(mysqli_error($conn)))
	{
		echo '<script>alert("'."Error Occurred".'");</script>';
		echo mysqli_error($conn);
		$errorcheck=true;
		break;
	}
	$table=$table."<tr>

	<td>".$dataArray[$i]['A']."</td>

	<td>".$dataArray[$i]['B']."</td>

	<td>".$dataArray[$i]['C']."</td>

	<td>".$dataArray[$i]['D']."</td>

	<td>".$dataArray[$i]['E']."</td>

	<td>".$dataArray[$i]['F']."</td>

	<td>".$dataArray[$i]['G']."</td>

	<td>".$dataArray[$i]['H']."</td>

	<td>".$dataArray[$i]['I']."</td>

	<td>".$dataArray[$i]['J']."</td>

	<td>".$dataArray[$i]['K']."</td>

	<td>".$dataArray[$i]['L']."</td>

	<td>".$dataArray[$i]['M']."</td>

	<td>".$dataArray[$i]['N']."</td>

	<td>".$dataArray[$i]['O']."</td>

	<td>".$dataArray[$i]['P']."</td>
	
	<td>".$dataArray[$i]['Q']."</td>

	<td>".$dataArray[$i]['R']."</td>

	<td>".$dataArray[$i]['S']."</td>

	<td>".$dataArray[$i]['T']."</td>

	<td>".$dataArray[$i]['U']."</td>

	<td>".$dataArray[$i]['V']."</td>

</tr>";
	$added_accnid[$i-2]=$dataArray[$i]['A'];
	$i+=1;
	$sql = "UPDATE books SET ";
	}
	
}
if(!$errorcheck)
{
	echo $table;
	echo '<script>alert("Updation successfully completed");</script>';
}
} 

else
{

$sql = "SELECT * FROM books WHERE accessid=";
//echo $sql;
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
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['almirah']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['registerpage']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['subject']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['type']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['lang']."'>
			</td>
			<td>
			<input type='text' class='updfrm1 form-control'  value='".$row['tag']."'>
			</td>
			

		</tr>
			
				";

	
	}
}
}
?>