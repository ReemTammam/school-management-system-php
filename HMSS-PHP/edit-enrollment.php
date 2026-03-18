<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error); // ADDED SEMICOLON

// Initialize variables
$enrollment_id = '';
if (!empty($_GET['EnrollmentID'])){
    $enrollment_id = $_GET['EnrollmentID'];
}

// Display all enrollment records
$sql = "SELECT e.*, s.FName, s.LName, c.Subject 
        FROM enrollment e 
        JOIN students s ON e.StudID = s.StudID 
        JOIN class c ON e.ClassID = c.ClassID
        ORDER BY e.EnrollmentID";
$result = $conn->query($sql);

if($result->num_rows > 0){
 echo "<h3>All Enrollment Records - Click to Edit</h3>";
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>EnrollmentID</th>
	    <th>Student ID</th>
	    <th>Student Name</th>
        <th>Class ID</th>
        <th>Class Subject</th>
        <th>Final Grade</th>
        <th>Attendance</th>
        <th>Edit</th>
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
		<td> <a href="edit-enrollment.php?EnrollmentID='.$row['EnrollmentID'].'">Edit</a></td>
	</tr>';	
}
echo "</table>";

// Things to do, after the "updatebtn" or "deletebtn" button is clicked.
if(isset($_POST['updatebtn']))
{
    $enrollment_id = $_POST['EnrollmentIDtb'];
    $final_grade = $_POST['FinalGradetb'];
    $attendance = $_POST['Attendancetb'];
    
    $sql_update = "UPDATE enrollment SET FinalGrade = '$final_grade', Attendance = '$attendance' WHERE EnrollmentID='$enrollment_id'";
    $resultupdate = $conn->query($sql_update);
    
    if($resultupdate) {
        echo "Records updated successfully";
    }

} else if (isset($_POST['deletebtn'])){
    $enrollment_id = $_POST['EnrollmentIDtb'];
    $sqldelete = "DELETE FROM enrollment WHERE EnrollmentID='$enrollment_id'";
    $delete = $conn->query($sqldelete);
    if($delete) { 
        echo "Record deleted successfully!";
    }
}

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
<h3>Update Enrollment</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Enrollment ID : <input type="number" name="EnrollmentIDtb" value="<?php echo $enrollment_id; ?>" required/><br/><br/>
    Final Grade : <input type="number" name="FinalGradetb" min="0" max="100" step="0.01"/><br/><br/>
    Attendance : <input type="number" name="Attendancetb" min="0" max="100"/><br/><br/>
    <input type="submit" value="Update" name="updatebtn"/>
    <input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this enrollment?')"/>
</form>
<!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>