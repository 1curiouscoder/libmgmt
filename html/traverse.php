<?php
//this file is used to traverse books in the database and provide data to jquery to display.
require_once "connect.php";

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
$row = mysqli_fetch_assoc($result);

echo json_encode("<p>Hello</p>");


}
?>