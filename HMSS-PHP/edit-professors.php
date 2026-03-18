<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error); // ADDED SEMICOLON

// Initialize variables
$pid = '';
if (!empty($_GET['ProfID'])){
    $pid = $_GET['ProfID'];
}

// Display all professors table
$sql = "SELECT * FROM professors";
$result = $conn->query($sql);
if($result->num_rows > 0){
 echo "<h3>All Professors</h3>";
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>ProfID</th>
	    <th>FName</th>
	    <th>LName</th>
	    <th>Age</th>
        <th>Gender</th>
        <th>Subject</th>
        <th>Grade</th>
        <th>YearTeach</th>
        <th>YearlySalary</th>
	    <th>Edit</th>
	</tr>";
}
while ($row = $result -> fetch_assoc()){
	echo '<tr>
		<td> '.$row['ProfID'].' </td>
	    <td> '.$row['FName'].' </td>
	    <td> '.$row['LName'].' </td>
	    <td> '.$row['Age'].' </td>
        <td> '.$row['Gender'].' </td>
        <td> '.$row['Subject'].' </td>
        <td> '.$row['Grade'].' </td>
        <td> '.$row['YearTeach'].' </td>
        <td> '.$row['YearlySalary'].' </td>
		<td> <a href="edit-professors.php?ProfID='.$row['ProfID'].'">Edit</a></td>
	</tr>';	
}
echo "</table>";

// Things to do, after the "updatebtn" or "deletebtn" button is clicked.
if(isset($_POST['updatebtn']))
{
    $pid = $_POST['ProfIDtb'];
    $sql_update= "UPDATE professors SET FName='$_POST[FNtb]', LName='$_POST[LNtb]', Age = '$_POST[Agetb]', Gender = '$_POST[Gendertb]', Subject = '$_POST[Subjecttb]', Grade = '$_POST[Gradetb]', YearTeach = '$_POST[YearTeachtb]', YearlySalary = '$_POST[YearlySalarytb]' WHERE ProfID='$pid'";
    
    $resultupdate = $conn->query($sql_update);
    
    if($resultupdate) {
        echo "Records updated successfully";
    }

} else if (isset($_POST['deletebtn'])){
    $pid = $_POST['ProfIDtb'];
    $sqldelete = "DELETE FROM professors WHERE ProfID='$pid'";
    $delete = $conn->query($sqldelete);
    if($delete) { 
        echo "Record deleted successfully!";
    }
}

// Display edit form for specific professor if one is selected
if (!empty($pid)) {
    $sql = "SELECT * FROM professors WHERE ProfID='$pid'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>Editing Professor: " . $row['FName'] . " " . $row['LName'] . " (ID: " . $row['ProfID'] . ")</h3>";
    }
}
?>

<hr>
<h3>Edit Professor Form</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    ProfID : <input type="text" name="ProfIDtb" value="<?php echo $pid; ?>" required/><br/><br/>
    First Name : <input type="text" name="FNtb" required/><br/><br/>
    Last Name : <input type="text" name="LNtb" required/><br/><br/>
    Age : <input type="number" name="Agetb" required/><br/><br/>
    Gender : <input type="text" name="Gendertb" required/><br/><br/>
    Subject : <input type="text" name="Subjecttb" required/><br/><br/>
    Grade : <input type="number" name="Gradetb" min="1" max="8" required/><br/><br/>
    YearTeach : <input type="number" name="YearTeachtb" required/><br/><br/>
    YearlySalary : <input type="number" name="YearlySalarytb" required/><br/><br/>
    <input type="submit" value="Update" name="updatebtn"/>
    <input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this professor?')"/>
</form>
<!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>