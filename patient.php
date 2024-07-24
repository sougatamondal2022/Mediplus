<?php
$server = "localhost";
$username = "root";
$password = "";
$con = mysqli_connect($server, $username, $password);
if (!$con) {
    die("connection failed" . mysqli_connect_error());
}
//echo "connection to the database";

$matching_data = array();


$serial_number = rand(10, 99);
$sno =$serial_number;

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
    //echo "Matching data in sdoctor table:<br>";
    while ($row = mysqli_fetch_assoc($region_result)) {
    $doctor_data = array(
        'sno' => $row['sno'],
        'Dname' => $row['Dname'],
        'Dregion' => $row['Dregion'],
        'Dphone' => $row['Dphone'],
        'Dspe' => $row['Dspe']
    );
    $matching_data[] = $doctor_data;
    // Your existing code to echo the data remains the same
}
}

// Assuming you have a table called `spatient` in the first database
 // Change 'your_first_database_name' to your actual first database name

$sql = "INSERT INTO `spatient`.`spatient` (`sno`, `pname`, `pregion`, `pphone`, `pspe`) VALUES ('$sno', '$Patient_name', '$Patient_Region', '$Patient_phone', '$Patient_specialization');";

//if ($con->query($sql) == true) {
  // echo " successfull inserted";
    
//} else {
    //echo " failed";
//} 
session_start();
$_SESSION['$sno']=$sno;
$_SESSION['$Patient_name']=$Patient_name;
$_SESSION['$Patient_Region']=$Patient_Region;
$_SESSION['$Patient_phone']=$Patient_phone;
$_SESSION['$Patient_specialization']=$Patient_specialization;
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Doctor List</title>
	<link rel="stylesheet" href="doc_card.css">
</head>
<header>
  
    <h2><img src="img/logo.png" alt="">at your service!</h2>
    <nav>
      <a href="index.html">Home</a>
      <a href="">About</a>
      <a href="">Gallery</a>
      <a href="">Contact</a>
    </nav>
  </header>
  <div class="wrapper">
    <section id='steezy'>
      <h2>Here are the list of docters available by your nearest</h2>
    <p>"Our service allows you to book appointments with the doctor of your choice. We offer a wide selection of highly qualified doctors, ensuring that you can find the best healthcare professional for your needs. Whether you require a specialist or a general practitioner, we make it easy to schedule appointments at your preferred location. With our convenient booking system, you can quickly and easily arrange consultations with top doctors, providing you with access to quality healthcare services."




</p>

    </section>
  </div>
</body>
<body>
    <div class="doctor-container">
        <?php for ($i = 0; $i < count($matching_data); $i++) { ?>
            <div class="doctor-card">
                <img src="resources/<?php echo $i + 1; ?>.jpeg" class="doctor-image">
                <?php 
                if (!empty($matching_data[$i])) {
                    $doctor = $matching_data[$i];
                    echo "<p>Doctor Name: " . $doctor['Dname'] . "</p>";
                    echo "<p>Region: " . $doctor['Dregion'] . "</p>";
                    echo "<p>Phone: " . $doctor['Dphone'] . "</p>";
                    echo "<p>Specialization: " . $doctor['Dspe'] . "</p>";
                    echo "<a href='payment.php?sno1=" . $doctor['sno'] . "&Dname=" . $doctor['Dname'] . "&Dregion=" . $doctor['Dregion'] . "&Dphone=" . $doctor['Dphone'] . "&Dspe=" . $doctor['Dspe'] . "'><button class='appointment-button'>Book Appointment</button></a>";
                } else {
                    echo "No matching data found.";
                }
                ?>
            </div>
        <?php } ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
         