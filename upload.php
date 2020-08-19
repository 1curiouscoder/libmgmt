<?php
require_once "connect.php";
require "functions.php";
//print_r($_FILES);	//Check all $_FILES variables

				
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$files=$_FILES['fileupload'];
$tmp_name=$files['tmp_name'];
$name=$files['name'];
$destination=$name;
$spreadsheet = $reader->load($tmp_name);

$dataArray = $spreadsheet->getActiveSheet()
    ->rangeToArray(	
        'A1:Z99999',     // The workshet range that we want to retrieve
        NULL,        // Value that should be returned for empty cells
        TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
        TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
        TRUE         // Should the array be indexed by cell row and cell column
    ); // this fetches values of the sheet and stores it in an arrya dataArray.
/*
// code for accessing cells cell by cell    
for($i=1;$i<26;$i++)
{
	$row =$spreadsheet->getActiveSheet()->getCellByColumnAndRow($i, 2)->getValue();
	echo $row;
	echo "<br>";
	
}
*/
$i=2;
$accessid_check = getallAccessid(); // contains all the accession ids inserted in the database 

$sql = "INSERT INTO books (accessid,author,title,volume,publisher,yop,pages,source,classno,bookno,cost,billno,withdrawn,entrydate,DDCNO,remarks,almirah,registerpage,subject,type,lang,tag) VALUES ";
$table = "";
$added_accnid = array("null"); // used to store accessionid that are added to sql query
while(!empty(checkpost($dataArray[$i]['A']))) //runs loop until encounters any empty accessionid cell 
{
	if(!in_array($dataArray[$i]['A'],$accessid_check) && !in_array($dataArray[$i]['A'],$added_accnid) && !empty(checkpost($dataArray[$i]['A'])))
	{
		$added_accnid[$i-2] = $dataArray[$i]['A'];
		if(!empty(checkpost($dataArray[$i+1]['A'])) && !in_array($dataArray[$i+1]['A'],$accessid_check) && !in_array($dataArray[$i+1]['A'],$added_accnid))
		{ 	
		$sql=$sql.'("'.$dataArray[$i]["A"].'","'.$dataArray[$i]["B"].'","'.$dataArray[$i]['C'].'","'.$dataArray[$i]['D'].'","'.$dataArray[$i]['E'].'","'.$dataArray[$i]['F'].'","'.$dataArray[$i]['G'].'","'.$dataArray[$i]['H'].'","'.$dataArray[$i]['I'].'","'.$dataArray[$i]['J'].'","'.$dataArray[$i]['K'].'","'.$dataArray[$i]['L'].'","'.$dataArray[$i]['M'].'","'.$dataArray[$i]['N'].'","'.$dataArray[$i]['O'].'","'.$dataArray[$i]['P'].'","'.$dataArray[$i]['Q'].'","'.$dataArray[$i]['R'].'","'.$dataArray[$i]['S'].'","'.$dataArray[$i]['T'].'","'.$dataArray[$i]['U'].'","'.$dataArray[$i]['V'].'"), ';
		}
		else
		{
		$sql=$sql.'("'.$dataArray[$i]["A"].'","'.$dataArray[$i]["B"].'","'.$dataArray[$i]['C'].'","'.$dataArray[$i]['D'].'","'.$dataArray[$i]['E'].'","'.$dataArray[$i]['F'].'","'.$dataArray[$i]['G'].'","'.$dataArray[$i]['H'].'","'.$dataArray[$i]['I'].'","'.$dataArray[$i]['J'].'","'.$dataArray[$i]['K'].'","'.$dataArray[$i]['L'].'","'.$dataArray[$i]['M'].'","'.$dataArray[$i]['N'].'","'.$dataArray[$i]['O'].'","'.$dataArray[$i]['P'].'","'.$dataArray[$i]['Q'].'","'.$dataArray[$i]['R'].'","'.$dataArray[$i]['S'].'","'.$dataArray[$i]['T'].'","'.$dataArray[$i]['U'].'","'.$dataArray[$i]['V'].'")';
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

	<td>".$dataArray[$i]['U']."</td>

	<td>".$dataArray[$i]['T']."</td>

	<td>".$dataArray[$i]['V']."</td>	

</tr>";
	}
$i+=1;
}

mysqli_query($conn,$sql);

if(!empty(mysqli_error($conn)))
{	
	echo $sql;
	echo mysqli_error($conn);
	echo "<script>alert('Please check your file')</script>";
}
else
{	

	echo $table;
	echo "<script>alert('Data successfully inserted')</script>";
}
/*
$res=move_uploaded_file($tmp_name, $destination);
if($res) {
	$msg='Uploaded successfully';
}
else {
	$msg='Error';
}
//echo $msg;
print_r($files);
*/

?>