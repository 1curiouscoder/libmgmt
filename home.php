<?php
require_once "connect.php";
$data = [];
$sql1 = "SELECT * FROM books";
$sql2 = "SELECT * FROM books WHERE lang='english'";
$sql3 = "SELECT * FROM books WHERE lang='hindi'";
$sql4 = "SELECT * FROM books WHERE type='textbook'";
$sql5 = "SELECT * FROM books WHERE type='story book'";
$sql6 = "SELECT * FROM books WHERE type='novel'";
$sql7 = "SELECT * FROM books WHERE type='magazine'";
$sql8 = "SELECT * FROM accessrec WHERE active='true'";

$res = mysqli_query($conn,$sql1);
array_push($data,mysqli_num_rows($res));
$res = mysqli_query($conn,$sql2);
array_push($data,mysqli_num_rows($res));
$res = mysqli_query($conn,$sql3);
array_push($data,mysqli_num_rows($res));
$res = mysqli_query($conn,$sql4);
array_push($data,mysqli_num_rows($res));
$res = mysqli_query($conn,$sql5);
array_push($data,mysqli_num_rows($res));
$res = mysqli_query($conn,$sql6);
array_push($data,mysqli_num_rows($res));
$res = mysqli_query($conn,$sql7);
array_push($data,mysqli_num_rows($res));
$res = mysqli_query($conn,$sql8);
array_push($data,mysqli_num_rows($res));
echo json_encode($data);
?>