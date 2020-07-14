<?php
require_once "connect.php";
require_once "functions.php";
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
        'A1:Z20000',     // The workshet range that we want to retrieve
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
if(getaccessid("End"))
{
$i=getaccessid("End")+2;	
}
else
{
	$i=2;
}

$sql = "INSERT INTO books (accessid,author,title,volume,publisher,yop,pages,source,classno,bookno,cost,billno,withdrawn,entrydate,DDCNO,remarks) VALUES ";
$table = "";
while(!empty(checkpost($dataArray[$i]['A']))) //runs loop until encounters any empty accessionid cell 
{
	if(!empty(checkpost($dataArray[$i+1]['A'])))
	{ 	
	$sql=$sql.'("'.$dataArray[$i]["A"].'","'.$dataArray[$i]["B"].'","'.$dataArray[$i]['C'].'","'.$dataArray[$i]['D'].'","'.$dataArray[$i]['E'].'","'.$dataArray[$i]['F'].'","'.$dataArray[$i]['G'].'","'.$dataArray[$i]['H'].'","'.$dataArray[$i]['I'].'","'.$dataArray[$i]['J'].'","'.$dataArray[$i]['K'].'","'.$dataArray[$i]['L'].'","'.$dataArray[$i]['M'].'","'.$dataArray[$i]['N'].'","'.$dataArray[$i]['O'].'","'.$dataArray[$i]['P'].'"),';
	}
	else
	{
	$sql=$sql.'("'.$dataArray[$i]["A"].'","'.$dataArray[$i]["B"].'","'.$dataArray[$i]['C'].'","'.$dataArray[$i]['D'].'","'.$dataArray[$i]['E'].'","'.$dataArray[$i]['F'].'","'.$dataArray[$i]['G'].'","'.$dataArray[$i]['H'].'","'.$dataArray[$i]['I'].'","'.$dataArray[$i]['J'].'","'.$dataArray[$i]['K'].'","'.$dataArray[$i]['L'].'","'.$dataArray[$i]['M'].'","'.$dataArray[$i]['N'].'","'.$dataArray[$i]['O'].'","'.$dataArray[$i]['P'].'")';
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

</tr>";
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