<?php
$conn = @new mysqli("localhost","root","");
$dbname='libmgmt';
$sql = "CREATE DATABASE IF NOT EXISTS `libmgmt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci"
;
$sql1 = "CREATE TABLE `accessrec` (
    `id` int(11) NOT NULL,
    `accessid` int(11) NOT NULL,
    `name` varchar(11) NOT NULL,
    `bname` varchar(50) NOT NULL,
    `issuedate` date NOT NULL,
    `returndate` date NOT NULL,
    `actual` date NOT NULL,
    `active` varchar(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql2 = "CREATE TABLE `books` (
    `accessid` int(11) NOT NULL,
    `author` varchar(50) NOT NULL,
    `title` varchar(100) NOT NULL,
    `volume` varchar(10) NOT NULL,
    `publisher` varchar(50) NOT NULL,
    `yop` year(4) NOT NULL,
    `pages` varchar(11) NOT NULL,
    `source` varchar(100) NOT NULL,
    `classno` varchar(10) NOT NULL,
    `bookno` varchar(10) NOT NULL,
    `cost` decimal(20,3) NOT NULL,
    `billno` varchar(10) NOT NULL,
    `withdrawn` date NOT NULL,
    `entrydate` date NOT NULL,
    `DDCNO` varchar(11) NOT NULL,
    `remarks` varchar(100) NOT NULL,
    `almirah` varchar(20) NOT NULL,
    `registerpage` varchar(20) NOT NULL,
    `subject` varchar(100) NOT NULL,
    `type` varchar(10) NOT NULL,
    `lang` varchar(10) NOT NULL,
    `tag` varchar(100) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$sql3 = "CREATE TABLE `user` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `uname` varchar(100) NOT NULL,
    `pass` varchar(100) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$sql4  ="ALTER TABLE `accessrec`
ADD PRIMARY KEY (`id`)";
$sql5 ="
ALTER TABLE `books`
ADD PRIMARY KEY (`accessid`)";
$sql6="
ALTER TABLE `user`
ADD PRIMARY KEY (`id`)";
$sql7="
ALTER TABLE `accessrec`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$sql8="
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";

if (empty (mysqli_fetch_array(mysqli_query($conn,"SHOW DATABASES LIKE '$dbname'")))) 
{
    mysqli_query($conn,$sql); 
    $conn = @new mysqli("localhost","root","","libmgmt");
    mysqli_query($conn,$sql1); 
    mysqli_query($conn,$sql2); 
    mysqli_query($conn,$sql3);
    mysqli_query($conn,$sql4); 
    mysqli_query($conn,$sql5); 
    mysqli_query($conn,$sql6);
    mysqli_query($conn,$sql7); 
    mysqli_query($conn,$sql8);   
    echo mysqli_error($conn);
}
else
{
    $conn = new mysqli("localhost","root","","libmgmt");
}
$GLOBALS['conn'] = $conn;
?>