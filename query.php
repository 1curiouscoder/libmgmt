<?php
require_once "connect.php";
require_once "functions.php";
$data = checkpost($_POST['query']); // type of operation to be performed
$errorcode = 0; // keep in check the state of code
$querycreate = array('author','title','volume','publisher','yop','cost','withdrawn','entrydate'); 
if(isset($data))
{	
	if($data == "insertatend")
	{
	$sql = "SELECT * FROM books ORDER BY accessid DESC LIMIT 1";
		$row = mysqli_query($conn,$sql);
		$res = mysqli_fetch_assoc($row);
				echo $res['accessid'];
		
	}
	else if ($data == "search") {
		# code...
		$c =0; //checks if a date attribute is used in both places
		$index=NULL; // used to modify sql query with the given index attribute.
		$arr = @$_POST['data'];
		$srchdata = checkpost($_POST["srchdata"]);
		
		if(isset($_POST["srchtype"]) && isset($srchdata) && !empty($srchdata))
		{
			$sql = "SELECT * FROM `books` WHERE ";
				$srch = $_POST["srchtype"];
				
				switch ($srch) {
					case 'Accession Id':
						# code...
						$sql=$sql."accessid='".$_POST["srchdata"]."'";
						break;
					case 'Author':
						# code...
						$sql=$sql."author='".$_POST["srchdata"]."'";
						break;
					case 'Title':
						# code...
						$sql=$sql."title='".$_POST["srchdata"]."'";
						break;
					case 'Volume':
						# code...
						$sql=$sql."volume='".$_POST["srchdata"]."'";
						break;
					case 'Publisher':
						# code...
						$sql=$sql."publisher='".$_POST["srchdata"]."'";
						break;
					case 'Year of Publication':
						# code...
						$sql=$sql."yop='".$_POST["srchdata"]."'";
						break;
					case 'Pages':
						# code...
						$sql=$sql."pages='".$_POST["srchdata"]."'";
						break;
					case 'Source':
						# code...
						$sql=$sql."source='".$_POST["srchdata"]."'";
						break;
					case 'Class No.':
						# code...
						$sql=$sql."classno='".$_POST["srchdata"]."'";
						break;
					case 'Book No.':
						# code...
						$sql=$sql."bookno='".$_POST["srchdata"]."'";
						break;
					case 'Cost':
						# code...
						$sql=$sql."cost='".$_POST["srchdata"]."'";
						break;
					case 'Bill No.':
						# code...
						$sql=$sql."billno='".$_POST["srchdata"]."'";
						break;
					case 'Withdrawn date':
						# code...
						$sql=$sql."withdrawn='".$_POST["srchdata"]."'";
						break;
					case 'Entry date':
						# code...
						$sql=$sql."entrydate='".$_POST["srchdata"]."'";
						break;
					case 'DDC No.':
						# code...
						$sql=$sql."DD$C='".$_POST["srchdata"]."'";
						break;
					case 'Entry date(Starting)':
						# code...
						$sql=$sql."entrydate BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 7;
						break;
					case 'Entry date(Ending)':
						# code...
						$sql=$sql."entrydate BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 7;
						break;
					case 'Year of Publication(Starting)':
						# code...
						$sql=$sql."yop BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 4;
						break;
					case 'Year of Publication(Ending)':
						# code...
						$sql=$sql."yop BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 4;
						break;
					case 'Withdraw date(Starting)':
						# code...
						$sql=$sql."withdrawn BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 6;
						break;
					case 'Withdraw date(Ending)':
						# code...
						$sql=$sql."withdrawn BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 6;
						break;
					default:
						
						break;
				}
			
				for($i=0;$i<8;$i++)
				{
					
	@$arr[$i] = checkpost($arr[$i]);
		
	if(isset($arr[$i]) && !empty($arr[$i]))
				{
					if($c==1)
					{
						$sql = $sql." AND '".$arr[$index]."'";
						$arr[$index]=NULL;
						$c=0;
					
					}
$sql = $sql." AND ".$querycreate[$i]."='".$arr[$i]."'";

				}

		//echo $i."=>".@_POST["srchdata"$i"]." ";				
		}
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0)
		{
				while($row = mysqli_fetch_assoc($result))
				{
				echo   "	<tr><td>".$row['accessid']."</td>
		
			<td>".$row['author']."</td>
		
			<td>".$row['title']."</td>
		
			<td>".$row['volume']."</td>
		
			<td>".$row['publisher']."</td>
		
			<td>".$row['yop']."</td>
		
			<td>".$row['pages']."</td>
		
			<td>".$row['source']."</td>
		
			<td>".$row['classno']."</td>
		
			<td>".$row['bookno']."</td>
		
			<td>".$row['cost']."</td>
		
			<td>".$row['billno']."</td>
		
			<td>".$row['withdrawn']."</td>
		
			<td>".$row['entrydate']."</td>
		
			<td>".$row['DDCNO']."</td>
		
			<td>".$row['remarks']."</td>
		
		</tr>";
				}	
		}
		else
		{
			echo "<script> alert('no results')</script>";
		}
			}
			else
				{
					echo "<script>alert('fields are empty')</script>";
				}
		
	}

if($data == "insert")
		{
			if($_POST["inctype"] == "Start")
			{
			//code for fetching last element of database
			//<section
			$sql1 = "SELECT * FROM books ORDER BY accessid DESC LIMIT 1";
			$row = mysqli_query($conn,$sql1);
			$res = mysqli_fetch_assoc($row);
			// section/>
			//code for creating sql query for element insertion
			//<section
			$incsql = "INSERT INTO books (accessid,author,title,volume,publisher,yop,pages,source,classno,bookno,cost,billno,withdrawn,entrydate,DDCNO,remarks) VALUES( ";
			$incarr = $_POST['data'];
			

			for($i=0;$i<16;$i++)
			{	$value = checkpost($incarr[$i]);
				if(!isset($value) || empty($value))
				{
					$errorcode = 1;
				break;
				}

				if ($i==15) 
				{
				# code...
				$incsql = $incsql."'".$incarr[$i]."')";	
				continue;
				}
				$incsql = $incsql."'".$incarr[$i]."', ";
			}
			//echo $incsql;
			//</section
			for($j=$res['accessid'];$j>0;$j--)
				{

				if($errorcode==1)
				{
					break;
				}
				$idprev = $j;
				$idnex = $j+1;
				$sql = "UPDATE books SET accessid = '".$idnex."' WHERE accessid = '".$idprev."'";
				mysqli_query($conn,$sql);
				//echo mysqli_error($conn);
			}
			//$querycreate = array('accessid','author','title','volume','publisher','yop','pages','source','classno','bookno','cost','billno','withdrawn','entrydate','DDCNO','remarks');	
			if($errorcode==1)
				{
					echo "<script>alert('FIELDS ARE LEFT EMPTY PLEASE FILL FORM CORRECTLY')</script>";
				}
			else
				{
					mysqli_query($conn,$incsql);
							echo "QUERY SUCCEDED";
							//echo mysqli_error($conn);	
							//echo $incsql;
				}
			}

		if($_POST["inctype"] == "End")
			{
			//code for creating sql query for element insertion
			//<section
			$incsql = "INSERT INTO books (accessid,author,title,volume,publisher,yop,pages,source,classno,bookno,cost,billno,withdrawn,entrydate,DDCNO,remarks) VALUES( ";
			$incarr = $_POST['data'];
			

			for($i=0;$i<16;$i++)
				{	$value = checkpost($incarr[$i]);
					if(!isset($value) || empty($value))
					{
						$errorcode = 1;
					break;
					}

					if ($i==15) 
					{
					# code...
					$incsql = $incsql."'".$incarr[$i]."')";	
					continue;
					}
					$incsql = $incsql."'".$incarr[$i]."', ";
				}

				if($errorcode==1)
				{
					echo "<script>alert('FIELDS ARE LEFT EMPTY PLEASE FILL FORM CORRECTLY')</script>";
				}
			else
				{
					mysqli_query($conn,$incsql);
							echo "QUERY SUCCEDED";
							//echo mysqli_error($conn);	
							//echo $incsql;
				}
			
			
			}

		}
}

?>