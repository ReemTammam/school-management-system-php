<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

// Initialize variables
$enrollment_id = '';
if (!empty($_GET['EnrollmentID'])){
    $enrollment_id = $_GET['EnrollmentID'];
}

// Handle form submissions
if(isset($_POST['updatebtn']))
{
    $enrollment_id = $_POST['EnrollmentIDtb'];
    $final_grade = $_POST['FinalGradetb'];
    $attendance = $_POST['Attendancetb'];
    
    $sql_update = "UPDATE enrollment SET FinalGrade = '$final_grade', Attendance = '$attendance' WHERE EnrollmentID='$enrollment_id'";
    $resultupdate = $conn->query($sql_update);
    
    if($resultupdate) {
        echo "<p style='color: green;'>Enrollment record updated successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }

} else if (isset($_POST['deletebtn'])){
    $enrollment_id = $_POST['EnrollmentIDtb'];
    $sqldelete = "DELETE FROM enrollment WHERE EnrollmentID='$enrollment_id'";
    $delete = $conn->query($sqldelete);
    if($delete) { 
        echo "<p style='color: green;'>Enrollment record deleted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
} else if (isset($_POST['inserttb'])){ 
    $studid = $_POST['StudIDtb'];
    $classid = $_POST['ClassIDtb'];

    $sql = "INSERT INTO enrollment (StudID, ClassID) VALUES ('$studid', '$classid')";
    $result = $conn->query($sql);

    if($result) {
        echo "<p style='color: green;'>Enrollment record inserted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

// Display all enrollment records
$sql = "SELECT e.*, s.FName, s.LName, c.Subject 
        FROM enrollment e 
        JOIN students s ON e.StudID = s.StudID 
        JOIN class c ON e.ClassID = c.ClassID
        ORDER BY e.EnrollmentID";
$result = $conn->query($sql);

if($result->num_rows > 0){
 echo "<h3>Current Enrollment Records</h3>";
 echo "<table style='border: solid 1px black; width: 100%;'>
	<tr>
	    <th>EnrollmentID</th>
	    <th>Student ID</th>
	    <th>Student Name</th>
        <th>Class ID</th>
        <th>Class Subject</th>
        <th>Final Grade</th>
        <th>Attendance</th>
	</tr>";
}
while ($row = $result -> fetch_assoc()){
	echo '<tr>
		<td> '.$row['EnrollmentID'].' </td>
	    <td> '.$row['StudID'].' </td>
	    <td> '.$row['FName'].' '.$row['LName'].' </td>
        <td> '.$row['ClassID'].' </td>
        <td> '.$row['Subject'].' </td>
        <td> '.$row['FinalGrade'].' </td>
        <td> '.$row['Attendance'].'% </td>
	</tr>';	
}
echo "</table>";

// Display edit form for specific enrollment if one is selected
if (!empty($enrollment_id)) {
    $sql = "SELECT * FROM enrollment WHERE EnrollmentID='$enrollment_id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>Editing Enrollment ID: " . $row['EnrollmentID'] . "</h3>";
    }
}
?>

<hr>
<h3>Update Grades & Attendance</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Enrollment ID : <input type="number" name="EnrollmentIDtb" value="<?php echo $enrollment_id; ?>" required/><br/><br/>
    Final Grade : <input type="number" name="FinalGradetb" min="0" max="100" step="0.01"/><br/><br/>
    Attendance : <input type="number" name="Attendancetb" min="0" max="100"/><br/><br/>
    <input type="submit" value="Update" name="updatebtn"/>
    <input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this enrollment?')"/>
</form>

<hr>
<h3>Enroll New Student in Class</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Student ID : <input type="number" name="StudIDtb" required/><br/><br/>
    Class ID : <input type="number" name="ClassIDtb" required/><br/><br/>
    <input type="submit" value="Enroll Student" name="inserttb"/>
</form>

<hr>
<h3>Available Students</h3>
<?php
$sql = "SELECT StudID, FName, LName, Grade FROM students ORDER BY StudID";
$result = $conn->query($sql);
if($result->num_rows > 0){
    echo "<table style='border: solid 1px black;'><tr><th>ID</th><th>Name</th><th>Grade</th></tr>";
    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row['StudID']."</td><td>".$row['FName']." ".$row['LName']."</td><td>".$row['Grade']."</td></tr>";
    }
    echo "</table>";
}
?>

<h3>Available Classes</h3>
<?php
$sql = "SELECT ClassID, Subject, Grade FROM class ORDER BY ClassID";
$result = $conn->query($sql);
if($result->num_rows > 0){
    echo "<table style='border: solid 1px black;'><tr><th>ClassID</th><th>Subject</th><th>Grade Level</th></tr>";
    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row['ClassID']."</td><td>".$row['Subject']."</td><td>".$row['Grade']."</td></tr>";
    }
    echo "</table>";
}
?>
<!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>