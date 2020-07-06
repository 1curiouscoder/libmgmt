<?php
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