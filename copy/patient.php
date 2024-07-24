
<?php
$server = "localhost";
$username = "root";
$password = "";
$con = mysqli_connect($server, $username, $password);
if (!$con) {
    die("connection failed" . mysqli_connect_error());
}
echo "connection to the database";

$sno = $_POST['sno'];
$Patient_name = $_POST['Patient_name'];
$Patient_Region = $_POST['Patient_Region'];
$Patient_phone = $_POST['Patient_phone'];
$Patient_specialization = $_POST['Patient_specialization'];

// First, query the region from the second database
$second_db = "sdoctor";
mysqli_select_db($con, $second_db);
$region_query = "SELECT * FROM `sdoctor` WHERE `Dregion` = '$Patient_Region' and `Dspe` ='$Patient_specialization'";
$region_result = mysqli_query($con, $region_query);
if (!$region_result || mysqli_num_rows($region_result) == 0) {
    die("Region not found in the second database");
} else {
    echo "Matching data in sdoctor table:<br>";
    while ($row = mysqli_fetch_assoc($region_result)) {

        echo "Sno: " . $row['sno'] . "<br>";
        echo "Doctor Name: " . $row['Dname'] . "<br>";
        echo "Region: " . $row['Dregion'] . "<br>";
        echo "Phone: " . $row['Dphone'] . "<br>";
        echo "Specialization: " . $row['Dspe'] . "<br>";
        echo "<br>";
        
        echo "<a href='payment.php?sno1=" . $row['sno'] . "&Dname=" . $row['Dname'] . "&Dregion=" . $row['Dregion'] . "&Dphone=" . $row['Dphone'] . "&Dspe=" . $row['Dspe'] . "'><button class='btn-lg btn-block'>Process payment.</button></a>";

        echo "<br>";
    }
}

// Assuming you have a table called `spatient` in the first database
 // Change 'your_first_database_name' to your actual first database name

$sql = "INSERT INTO `spatient`.`spatient` (`sno`, `pname`, `pregion`, `pphone`, `pspe`) VALUES ('$sno', '$Patient_name', '$Patient_Region', '$Patient_phone', '$Patient_specialization');";

if ($con->query($sql) == true) {
   echo " successfull inserted";
    
} else {
    echo " failed";
} 
session_start();
$_SESSION['$sno']=$sno;
$_SESSION['$Patient_name']=$Patient_name;
$_SESSION['$Patient_Region']=$Patient_Region;
$_SESSION['$Patient_phone']=$Patient_phone;
$_SESSION['$Patient_specialization']=$Patient_specialization;
 ?>
