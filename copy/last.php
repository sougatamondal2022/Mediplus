<?php

session_start();
/*
echo "Received data from patient script:<br>";
echo "Sno: " . $_SESSION['$sno'] . "<br>";
echo "Patient Name: " . $_SESSION['$Patient_name']. "<br>";
echo "Region: " . $_SESSION['$Patient_Region'] . "<br>";
echo "Phone: " . $_SESSION['$Patient_phone'] . "<br>";
echo "Specialization: " . $_SESSION['$Patient_specialization'] . "<br>";

// You can perform additional operations here, such as updating another table or sending an email
echo "Sno: " . $_SESSION['sno1'] . "<br>";
echo "Doctor Name: " . $_SESSION['Dname']. "<br>";
echo "Region: " . $_SESSION['Dregion'] . "<br>";
echo "Phone: " . $_SESSION['Dphone']. "<br>";
echo "Specialization: " . $_SESSION['Dspe'] . "<br>";
// Return a response to the previous script
echo "Response sent from last.php";*/

if (isset($_POST['downloadReceipt'])) {
    $sno1 = $_SESSION['sno1'];
    $Doctor_name = $_SESSION['Dname'];
    $Region = $_SESSION['Dregion'];
    $Phone  = $_SESSION['Dphone'];
    $Specialization = $_SESSION['Dspe'];
    $sno = $_SESSION['$sno'];
    $Patient_name     = $_SESSION['$Patient_name'];
    $Patient_Region     = $_SESSION['$Patient_Region'];
    $Patient_phone    = $_SESSION['$Patient_phone'];
    $Patient_specialization    = $_SESSION['$Patient_specialization'];
    $content = "
        Welcome to your platform

        Doctor details:
        $sno1
        
        Doctor name:
        $Doctor_name
        
        Doctor Region:
        $Region 
        
        Phone number:
        $Phone
 
        Specialization:
        $Specialization

        Patient details:
        $sno
        
        Patient name:
        $Patient_name  
        
        Patient Region:
        $Patient_Region
        
        Patient Phone number:
        $Patient_phone
 
        Patient Specialization:
        $Patient_specialization 

    ";

    header('Content-Type: application/msword');
    header('Content-Disposition: attachment; filename="submission.doc"');
    echo $content;
    exit;
}
?>

<html>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       <h1>Click Download button to get Receipt.</h1>
        <button type="submit" name="downloadReceipt" id="convert-btn">Download Receipt</button>
    </form>
    <a href="chat.html"><button>Talk to doctor</button></a>
</body>
</html>
