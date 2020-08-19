<?php
require_once "connect.php";
require_once "functions.php";
$data = checkpost($_POST['query']); // type of operation to be performed
$errorcode = 0; // keep in check the state of code
$querycreate = array('accessid','author','title','volume','publisher','yop','pages','classno','bookno','cost','billno','withdrawn','entrydate','DDCNO','almirah','registerpage','subject','type','lang','tag'); 
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
		
		if(isset($_POST["srchtype"]) && isset($srchdata) && !empty($srchdata) || $srchdata=="0")
		{
			$sql = "SELECT * FROM `books` WHERE ";
				$srch = $_POST["srchtype"];
				
				switch ($srch) {
					case 'Accession id':
						# code...
						$sql=$sql."accessid='".$_POST["srchdata"]."'";
						break;
					case 'Accession id(Starting)':
						# code...
						$sql=$sql."accessid BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index =0;
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
					case 'Volume(Starting)':
						# code...
						$sql=$sql."volume  BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index =3;
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
					case 'Pages(Starting)':
						# code...
						$sql=$sql."pages  BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index =6;
						break;
					case 'Source':
						# code...
						$sql=$sql."source='".$_POST["srchdata"]."'";
						break;
					case 'Class No.':
						# code...
						$sql=$sql."classno='".$_POST["srchdata"]."'";
						break;
					case 'Class No.(Starting)':
						# code...
						$sql=$sql."classno BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index =7;
						break;
					case 'Book No.':
						# code...
						$sql=$sql."bookno='".$_POST["srchdata"]."'";
						break;
					case 'Book No.(Starting)':
						# code...
						$sql=$sql."bookno BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index =8;
						break;
					case 'Cost':
						# code...
						$sql=$sql."cost='".$_POST["srchdata"]."'";
						break;
					case 'Cost(Starting)':
						# code...
						$sql=$sql."cost BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index =9;
						break;
					case 'Bill No.':
						# code...
						$sql=$sql."billno='".$_POST["srchdata"]."'";
						break;
					case 'Bill No.(Starting)':
						# code...
						$sql=$sql."billno BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index =10;
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
						$sql=$sql."DDCNO='".$_POST["srchdata"]."'";
						break;
					case 'DDC No.(Starting)':
						# code...
						$sql=$sql."DDCNO BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index =13;
						break;
					case 'Almirah':
						# code...
						$sql=$sql."almirah='".$_POST["srchdata"]."'";
						break;
					case 'Almirah(Starting)':
						# code...
						$sql=$sql."almirah BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 14;
						break;
					case 'Register Page':
						# code...
						$sql=$sql."registerpage='".$_POST["srchdata"]."'";
						break;
					case 'Register Page(Starting)':
						# code...
						$sql=$sql."registerpage BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 15;
						break;		
					case 'Subject':
						# code...
						$sql=$sql."subject='".$_POST["srchdata"]."'";
						break;
					case 'Type':
						# code...
						$sql=$sql."type='".$_POST["srchdata"]."'";
						break;
					case 'Language':
						# code...
						$sql=$sql."lang='".$_POST["srchdata"]."'";
						break;
					case 'Tag':
						# code...
						$temp = explode(";",$_POST["srchdata"]);
						$sql = $sql."(0 < (SELECT ";
						for($i=0;$i<count($temp);$i++)
						{
						
						if($i==0)
						{
							$sql = $sql."LOCATE('".$temp[$i]."', tag) ";
						}
						else{
							$sql = $sql."AND LOCATE('".$temp[$i]."', tag) ";
						}
						
						}
						$sql=$sql."))";
						break;	
					case 'Year of Publication(Starting)':
						# code...
						$sql=$sql."yop BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 5;
						break;
					case 'Withdrawn date(Starting)':
						# code...
						$sql=$sql."withdrawn BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 11;
						break;
					case 'Entry date(Starting)':
						# code...
						$sql=$sql."entrydate BETWEEN '".$_POST["srchdata"]."'";
						$c=1;
						$index = 12;
						break;
					default:
						
						break;
				}
			
				for($i=0;$i<22;$i++)
				{
					
	@$arr[$i] = checkpost($arr[$i]);
		
	if(isset($arr[$i]) && !empty($arr[$i]))
				{
					if($c==1)
					{
						$sql = $sql." AND '".$arr[$index]."'";
						$c=0;
					}
else
{
$sql = $sql." AND ".$querycreate[$i]."='".$arr[$i]."'";
}
				}

		//echo $i."=>".@_POST["srchdata"$i"]." ";	
		
		}
		//var_dump( $arr);
		$result = mysqli_query($conn,$sql);
		//echo $sql;
		
		if(mysqli_num_rows($result)>0)
		{ 
				while($row = mysqli_fetch_assoc($result))
				{ 
				echo   "	
				
		<tr>

			<td><input type='checkbox' value='".$row['accessid']."' class='childupd' id = 'idchildupd'></td>

			<td><input type='checkbox' value='".$row['accessid']."' class='childdel' id = 'idchilddel'></td>

			<td>".$row['accessid']."</td>
		
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

			<td>".$row['almirah']."</td>

			<td>".$row['registerpage']."</td>

			<td>".$row['subject']."</td>

			<td>".$row['type']."</td>

			<td>".$row['lang']."</td>

			<td>".$row['tag']."</td>
		
		</tr>";
				}	
		}
		else
		{
			echo "1";
		}
			}
			else
				{
					echo "2";
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
			$incsql = "INSERT INTO books (accessid,author,title,volume,publisher,yop,pages,source,classno,bookno,cost,billno,withdrawn,entrydate,DDCNO,remarks,almirah,registerpage,subject,type,lang,tag) VALUES( ";
			$incarr = $_POST['data'];
			

			for($i=0;$i<22;$i++)
			{	$value = checkpost($incarr[$i]);
				if(!isset($value) || empty($value))
				{
					$errorcode = 1;
				break;
				}

				if ($i==21) 
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
					if(!empty(mysqli_error($conn)))
					{
						echo mysqli_error($conn);
					}
					else
					{
							echo "QUERY SUCCEDED";
							//echo mysqli_error($conn);	
							//echo $incsql;
					}
				}
			}

		if($_POST["inctype"] == "End")
			{
			//code for creating sql query for element insertion
			//<section
			$incsql = "INSERT INTO books (accessid,author,title,volume,publisher,yop,pages,source,classno,bookno,cost,billno,withdrawn,entrydate,DDCNO,remarks,almirah,registerpage,subject,type,lang,tag) VALUES( ";
			$incarr = $_POST['data'];
			

			for($i=0;$i<22;$i++)
				{	$value = checkpost($incarr[$i]);
					if(!isset($value) || empty($value))
					{
						$errorcode = 1;
					break;
					}

					if ($i==21) 
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
					if(!empty(mysqli_error($conn)))
					{
						echo mysqli_error($conn);
					}
					else
					{
							echo "QUERY SUCCEDED";
							//echo mysqli_error($conn);	
							//echo $incsql;
					}
				}
			
			
			}
			if($_POST["inctype"] == "Random")
			{
			//code for creating sql query for element insertion
			//<section
			$incsql = "INSERT INTO books (accessid,author,title,volume,publisher,yop,pages,source,classno,bookno,cost,billno,withdrawn,entrydate,DDCNO,remarks,almirah,registerpage,subject,type,lang,tag) ";
			$incarr = $_POST['data'];
			

			for($i=0;$i<count($incarr);$i++)
				{	
					if($i==0)
					{
						$incsql = $incsql."VALUES( ";
					}
					else
					{
						$incsql = $incsql.", ( ";
					}
					for($j=0;$j<22;$j++)
					{
					$value = checkpost($incarr[$i][$j]);
					if(!isset($value) || empty($value))
					{
						$errorcode = 1;
					break;
					}

					if ($j==21) 
					{
					# code...
					$incsql = $incsql."'".$incarr[$i][$j]."')";	
					continue;
					}
					$incsql = $incsql."'".$incarr[$i][$j]."', ";
					}
				}

				if($errorcode==1)
				{
					echo "<script>alert('FIELDS ARE LEFT EMPTY PLEASE FILL FORM CORRECTLY')</script>";
				}
			else
				{
					
					mysqli_query($conn,$incsql);
					if(!empty(mysqli_error($conn)))
					{
						echo mysqli_error($conn);
					}
					else
					{
							echo "QUERY SUCCEDED";
							//echo mysqli_error($conn);	
							//echo $incsql;
					}
					
					//echo $incsql;
				}
			
			
			}

		}
}

?>