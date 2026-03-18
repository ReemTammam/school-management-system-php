<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

// Initialize variables
$subject = '';
if (!empty($_GET['Subject'])){
    $subject = $_GET['Subject'];
}

// Handle form submissions
if(isset($_POST['updatebtn']))
{
    $subject = $_POST['Subjecttb'];
    $sql_update= "UPDATE class SET Grade = '$_POST[Gradetb]', ProfID = '$_POST[ProfIDtb]', Difficulty = '$_POST[Difficultytb]', SupplyFee = '$_POST[SupplyFeetb]' WHERE Subject='$subject'";
    
    $resultupdate = $conn->query($sql_update);
    
    if($resultupdate) {
        echo "Records updated successfully";
    }

} else if (isset($_POST['deletebtn'])){
    $subject = $_POST['Subjecttb'];
    $sqldelete = "DELETE FROM class WHERE Subject='$subject'";
    $delete = $conn->query($sqldelete);
    if($delete) { 
        echo "Record deleted successfully!";
    }
}

// Display all classes table
$sql = "SELECT * FROM class";
$result = $conn->query($sql);
if($result->num_rows > 0){
 echo "<h3>All Classes - Click to Edit</h3>";
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>Subject</th>
	    <th>Grade</th>
	    <th>ProfID</th>
	    <th>Difficulty</th>
        <th>SupplyFee</th>
	    <th>Edit</th>
	</tr>";
}
while ($row = $result -> fetch_assoc()){
	echo '<tr>
        <td> '.$row['Subject'].' </td>
        <td> '.$row['Grade'].' </td>
        <td> '.$row['ProfID'].' </td>
        <td> '.$row['Difficulty'].' </td>
        <td> '.$row['SupplyFee'].' </td>
		<td> <a href="edit-class.php?Subject='.$row['Subject'].'">Edit</a></td>
	</tr>';	
}
echo "</table>";

// Display edit form for specific class if one is selected
if (!empty($subject)) {
    $sql = "SELECT * FROM class WHERE Subject='$subject'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>Editing Class: " . $row['Subject'] . "</h3>";
    }
}
?>

<hr>
<h3>Edit Class Form</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Subject : <input type="text" name="Subjecttb" value="<?php echo $subject; ?>" required/><br/><br/>
    Grade : <input type="number" name="Gradetb" min="1" max="8" required/><br/><br/>
    ProfID : <input type="number" name="ProfIDtb" required/><br/><br/>
    Difficulty : <input type="number" name="Difficultytb" min="1" max="10" required/><br/><br/>
    SupplyFee : <input type="number" name="SupplyFeetb" min="0" required/><br/><br/>
    <input type="submit" value="Update" name="updatebtn"/>
    <input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this class?')"/>
</form>
<!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>
