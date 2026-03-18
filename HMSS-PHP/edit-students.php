<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

// Initialize variables
$studid = '';
if (!empty($_GET['StudID'])){
    $studid = $_GET['StudID'];
}

// Display all students table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
if($result->num_rows > 0){
 echo "<h3>All Students</h3>";
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>StudID</th>
	    <th>FName</th>
	    <th>LName</th>
	    <th>Age</th>
        <th>Gender</th>
        <th>Grade</th>
        <th>GPA</th>
        <th>ClassCount</th>
        <th>FavSubject</th>
        <th>FavTeacher</th>
        <th>DisciplineProbs</th>
	    <th>Edit</th>
	</tr>";
}
while ($row = $result -> fetch_assoc()){
	echo '<tr>
		<td> '.$row['StudID'].' </td>
	    <td> '.$row['FName'].' </td>
	    <td> '.$row['LName'].' </td>
	    <td> '.$row['Age'].' </td>
        <td> '.$row['Gender'].' </td>
        <td> '.$row['Grade'].' </td>
        <td> '.$row['GPA'].' </td>
        <td> '.$row['ClassCount'].' </td>
        <td> '.$row['FavSubject'].' </td>
        <td> '.$row['FavTeacher'].' </td>
        <td> '.$row['DisciplineProbs'].' </td>
		<td> <a href="edit-students.php?StudID='.$row['StudID'].'">Edit</a></td>
	</tr>';	
}
echo "</table>";

// Things to do, after the "updatebtn" or "deletebtn" button is clicked.
if(isset($_POST['updatebtn']))
{
    $studid = $_POST['StudIDtb'];
    $sql_update= "UPDATE students SET FName='$_POST[FNtb]', LName='$_POST[LNtb]', Age = '$_POST[Agetb]', Gender = '$_POST[Gendertb]', Grade = '$_POST[Gradetb]', GPA = '$_POST[GPAtb]', ClassCount = '$_POST[ClassCounttb]', FavSubject = '$_POST[FavSubjecttb]', FavTeacher = '$_POST[FavTeachertb]', DisciplineProbs = '$_POST[DisciplineProbstb]' WHERE StudID='$studid'";
    
    $resultupdate = $conn->query($sql_update);
    
    if($resultupdate) {
        echo "Records updated successfully";
    }

} else if (isset($_POST['deletebtn'])){
    $studid = $_POST['StudIDtb'];
    $sqldelete = "DELETE FROM students WHERE StudID='$studid'";
    $delete = $conn->query($sqldelete);
    if($delete) { 
        echo "Record deleted successfully!";
    }
}

// Display edit form for specific student if one is selected
if (!empty($studid)) {
    $sql = "SELECT * FROM students WHERE StudID='$studid'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>Editing Student: " . $row['FName'] . " " . $row['LName'] . " (ID: " . $row['StudID'] . ")</h3>";
    }
}
?>

<hr>
<h3>Edit Student Form</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    StudID : <input type="text" name="StudIDtb" value="<?php echo $studid; ?>"/><br/><br/>
    First Name : <input type="text" name="FNtb"/><br/><br/>
    Last Name : <input type="text" name="LNtb"/><br/><br/>
    Age : <input type="text" name="Agetb"/><br/><br/>
    Gender : <input type="text" name="Gendertb"/><br/><br/>
    Grade : <input type="text" name="Gradetb"/><br/><br/>
    GPA : <input type="text" name="GPAtb"/><br/><br/>
    ClassCount : <input type="text" name="ClassCounttb"/><br/><br/>
    FavSubject : <input type="text" name="FavSubjecttb"/><br/><br/>
    FavTeacher : <input type="text" name="FavTeachertb"/><br/><br/>
    DisciplineProbs : <input type="text" name="DisciplineProbstb"/><br/><br/>
    <input type="submit" value="Update" name="updatebtn"/>
    <input type="submit" value="Delete" name="deletebtn" onclick="return confirm('Are you sure you want to delete this student?')"/>
</form>
<!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>
