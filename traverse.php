<?php
//this file is used to traverse books in the database and provide data to jquery to display.
require_once "connect.php";

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
while($row = mysqli_fetch_assoc($result)){

echo "<tr>

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

</tr>";

}
}
?>