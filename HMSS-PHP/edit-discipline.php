<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error); // ADDED SEMICOLON

// Initialize variables
$log_id = '';
if (!empty($_GET['LogID'])){
    $log_id = $_GET['LogID'];
}

// Handle form submissions
if(isset($_POST['updatebtn']))
{
    $log_id = $_POST['LogIDtb'];
    $studid = $_POST['StudIDtb'];
    $date = $_POST['Datetb'];
    $description = $_POST['Descriptiontb'];
    $severity = $_POST['Severitytb'];
    
    $sql_update = "UPDATE discipline_log SET StudID = '$studid', Date = '$date', Description = '$description', Severity = '$severity' WHERE LogID='$log_id'";
    $resultupdate = $conn->query($sql_update);
    
    if($resultupdate) {
        echo "<p style='color: green;'>Discipline record updated successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }

} else if (isset($_POST['deletebtn'])){
    $log_id = $_POST['LogIDtb'];
    $sqldelete = "DELETE FROM discipline_log WHERE LogID='$log_id'";
    $delete = $conn->query($sqldelete);
    if($delete) { 
        echo "<p style='color: green;'>Discipline record deleted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
} else if (isset($_POST['inserttb'])){ 
    $studid = $_POST['StudIDtb'];
    $date = $_POST['Datetb'];
    $description = $_POST['Descriptiontb'];
    $severity = $_POST['Severitytb'];

    $sql = "INSERT INTO discipline_log (StudID, Date, Description, Severity) VALUES ('$studid', '$date', '$description', '$severity')";
    $result = $conn->query($sql);

    if($result) {
        echo "<p style='color: green;'>Discipline record inserted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

// Display all discipline records
$sql = "SELECT d.*, s.FName, s.LName 
        FROM discipline_log d 
        JOIN students s ON d.StudID = s.StudID 
        ORDER BY d.LogID";
$result = $conn->query($sql);
if($result->num_rows > 0){
 echo "<h3>All Discipline Records - Click to Edit</h3>";
 echo "<table style='border: solid 1px black; width: 100%;'>
	<tr>
	    <th>LogID</th>
	    <th>Student ID</th>
	    <th>Student Name</th>
	    <th>Date</th>
        <th>Description</th>
        <th>Severity</th>
        <th>Edit</th>
	</tr>";
}
while ($row = $result -> fetch_assoc()){
	echo '<tr>
        <td> '.$row['LogID'].' </td>
        <td> '.$row['StudID'].' </td>
        <td> '.$row['FName'].' '.$row['LName'].' </td>
        <td> '.$row['Date'].' </td>
        <td> '.$row['Description'].' </td>
        <td> '.$row['Severity'].' </td>
		<td> <a href="edit-discipline.php?LogID='.$row['LogID'].'">Edit</a></td>
	</tr>';	
}
echo "</table>";

// Display edit form for specific discipline record if one is selected
if (!empty($log_id)) {
    $sql = "SELECT * FROM discipline_log WHERE LogID='$log_id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>Editing Discipline Log ID: " . $row['LogID'] . "</h3>";
    }
}
?>

<hr>
<h3>Update Discipline Record</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    LogID : <input type="number" name="LogIDtb" value="<?php echo $log_id; ?>" required/><br/><br/>
    Student ID : <input type="number" name="StudIDtb" required/><br/><br/>
    Date : <input type="date" name="Datetb" required/><br/><br/>
    Description : <input type="text" name="Descriptiontb" required/><br/><br/>
    Severity : 
    <select name="Severitytb" required>
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select><br/><br/>
    <input type="submit" value="Update" name="updatebtn"/>
    <input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this discipline record?')"/>
</form>

<hr>
<h3>Record New Discipline Incident</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Student ID : <input type="number" name="StudIDtb" required/><br/><br/>
    Date : <input type="date" name="Datetb" required/><br/><br/>
    Description : <input type="text" name="Descriptiontb" required/><br/><br/>
    Severity : 
    <select name="Severitytb" required>
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select><br/><br/>
    <input type="submit" value="Record Incident" name="inserttb"/>
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
<!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>
