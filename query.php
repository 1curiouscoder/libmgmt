<?php
require_once "connect.php";
$data = $_POST['query'];
if(isset($data))
{
	if($data == "accessid")
	{
		$sql = "SELECT * FROM books ORDER BY accessid DESC LIMIT 1";
		$row = mysqli_query($conn,$sql);
		while($res = mysqli_fetch_assoc($row)){
				echo $res['accessid'];
			}
	}
	if ($data == "search") {
		# code...
		$sql = "SELECT * FROM `books` WHERE ";
		if(isset($_POST["srchtype"])){
				$srch = $_POST["srchtype"];
				switch ($srch) {
					case 'Accession Id':
						# code...
						$sql=$sql."accessid=".$_POST[0];
						break;
					case 'Author':
						# code...
						$sql=$sql."author=".$_POST[0];
						break;
					case 'Title':
						# code...
						$sql=$sql."title=".$_POST[0];
						break;
					case 'Volume':
						# code...
						$sql=$sql."volume=".$_POST[0];
						break;
					case 'Publisher':
						# code...
						$sql=$sql."publisher=".$_POST[0];
						break;
					case 'Year of Publication':
						# code...
						$sql=$sql."yop=".$_POST[0];
						break;
					case 'Pages':
						# code...
						$sql=$sql."pages=".$_POST[0];
						break;
					case 'Source':
						# code...
						$sql=$sql."source=".$_POST[0];
						break;
					case 'Class No.':
						# code...
						$sql=$sql."classno=".$_POST[0];
						break;
					case 'Book No.':
						# code...
						$sql=$sql."bookno=".$_POST[0];
						break;
					case 'Cost':
						# code...
						$sql=$sql."cost=".$_POST[0];
						break;
					case 'Bill No.':
						# code...
						$sql=$sql."billno=".$_POST[0];
						break;
					case 'Withdraw date':
						# code...
						$sql=$sql."withdrawn=".$_POST[0];
						break;
					case 'Entry date':
						# code...
						$sql=$sql."entrydate=".$_POST[0];
						break;
					case 'DDC No.':
						# code...
						$sql=$sql."DDC=".$_POST[0];
						break;
					default:
						$error = "some of the fields are empty";
						break;
				}
			}
	}
}
?>