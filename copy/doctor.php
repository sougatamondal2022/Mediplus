<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
$server = "localhost";
$username = "root";
$password = "";
$con = mysqli_connect($server,$username,$password );
if(!$con){
    die("connection failed" . mysqli_connect_error());
}
echo"connection to the database";
$sno1 = $_POST['sno'];
$Doctor_name = $_POST['Doctor_name'];
$Region_name = $_POST['Region_name'];
$phone = $_POST['phone'];
$specialization = $_POST['specialization'];
 
$sql ="INSERT INTO `sdoctor`.`sdoctor` (`sno`, `Dname`, `Dregion`, `Dphone`, `Dspe`) VALUES ('$sno1', '$Doctor_name', '$Region_name', '$phone', '$specialization');";

if($con->query($sql) == true){
    echo " successfull inserted";
 }else{
    echo" failed";
 }
 
?>
</body>
</html>