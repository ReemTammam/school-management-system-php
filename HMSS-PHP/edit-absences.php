<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

// Initialize variables
$absence_id = '';
if (!empty($_GET['AbsenceID'])){
    $absence_id = $_GET['AbsenceID'];
}

// Handle form submissions
if(isset($_POST['updatebtn']))
{
    $absence_id = $_POST['AbsenceIDtb'];
    $studid = $_POST['StudIDtb'];
    $classid = $_POST['ClassIDtb'];
    $date = $_POST['Datetb'];
    $reason = $_POST['Reasontb'];
    
    $sql_update = "UPDATE absences SET StudID = '$studid', ClassID = '$classid', Date = '$date', Reason = '$reason' WHERE AbsenceID='$absence_id'";
    $resultupdate = $conn->query($sql_update);
    
    if($resultupdate) {
        echo "<p style='color: green;'>Absence record updated successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }

} else if (isset($_POST['deletebtn'])){
    $absence_id = $_POST['AbsenceIDtb'];
    $sqldelete = "DELETE FROM absences WHERE AbsenceID='$absence_id'";
    $delete = $conn->query($sqldelete);
    if($delete) { 
        echo "<p style='color: green;'>Absence record deleted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
} else if (isset($_POST['inserttb'])){ 
    $studid = $_POST['StudIDtb'];
    $classid = $_POST['ClassIDtb'];
    $date = $_POST['Datetb'];
    $reason = $_POST['Reasontb'];

    $sql = "INSERT INTO absences (StudID, ClassID, Date, Reason) VALUES ('$studid', '$classid', '$date', '$reason')";
    $result = $conn->query($sql);

    if($result) {
        echo "<p style='color: green;'>Absence record inserted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

// Display all absences
$sql = "SELECT a.*, s.FName, s.LName, c.Subject 
        FROM absences a 
        JOIN students s ON a.StudID = s.StudID 
        JOIN class c ON a.ClassID = c.ClassID
        ORDER BY a.AbsenceID";
$result = $conn->query($sql);
if($result->num_rows > 0){
 echo "<h3>All Absence Records - Click to Edit</h3>";
 echo "<table style='border: solid 1px black; width: 100%;'>
	<tr>
	    <th>AbsenceID</th>
	    <th>Student ID</th>
	    <th>Student Name</th>
	    <th>Class ID</th>
        <th>Class Subject</th>
	    <th>Date</th>
        <th>Reason</th>
        <th>Edit</th>
	</tr>";
}
while ($row = $result -> fetch_assoc()){
	echo '<tr>
        <td> '.$row['AbsenceID'].' </td>
        <td> '.$row['StudID'].' </td>
        <td> '.$row['FName'].' '.$row['LName'].' </td>
        <td> '.$row['ClassID'].' </td>
        <td> '.$row['Subject'].' </td>
        <td> '.$row['Date'].' </td>
        <td> '.$row['Reason'].' </td>
		<td> <a href="edit-absences.php?AbsenceID='.$row['AbsenceID'].'">Edit</a></td>
	</tr>';	
}
echo "</table>";

// Display edit form for specific absence if one is selected
if (!empty($absence_id)) {
    $sql = "SELECT * FROM absences WHERE AbsenceID='$absence_id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>Editing Absence ID: " . $row['AbsenceID'] . "</h3>";
    }
}
?>

<hr>
<h3>Update Absence Record</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    AbsenceID : <input type="number" name="AbsenceIDtb" value="<?php echo $absence_id; ?>" required/><br/><br/>
    Student ID : <input type="number" name="StudIDtb" required/><br/><br/>
    Class ID : <input type="number" name="ClassIDtb" required/><br/><br/>
    Date : <input type="date" name="Datetb" required/><br/><br/>
    Reason : <input type="text" name="Reasontb" required/><br/><br/>
    <input type="submit" value="Update" name="updatebtn"/>
    <input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this absence record?')"/>
</form>

<hr>
<h3>Record New Absence</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Student ID : <input type="number" name="StudIDtb" required/><br/><br/>
    Class ID : <input type="number" name="ClassIDtb" required/><br/><br/>
    Date : <input type="date" name="Datetb" required/><br/><br/>
    Reason : <input type="text" name="Reasontb" required/><br/><br/>
    <input type="submit" value="Record Absence" name="inserttb"/>
</form>

<hr>
<h3>Available Students</h3>
<?php
$sql = "SELECT StudID, FName, LName FROM students ORDER BY StudID";
$result = $conn->query($sql);
if($result->num_rows > 0){
    echo "<table style='border: solid 1px black;'><tr><th>ID</th><th>Name</th></tr>";
    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row['StudID']."</td><td>".$row['FName']." ".$row['LName']."</td></tr>";
    }
    echo "</table>";
}
?>
<h3>Available Classes</h3>
<?php
$sql = "SELECT ClassID, Subject FROM class ORDER BY ClassID";
$result = $conn->query($sql);
if($result->num_rows > 0){
    echo "<table style='border: solid 1px black;'><tr><th>ClassID</th><th>Subject</th></tr>";
    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row['ClassID']."</td><td>".$row['Subject']."</td></tr>";
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