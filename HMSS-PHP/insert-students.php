<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
if($result->num_rows > 0){
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
	</tr>';	
}

echo "</table>";

if(isset($_POST['inserttb'])){ 
	$fn = $_POST['FNtb'];
    $ln = $_POST['LNtb'];
	$age = $_POST['Agetb'];
    $gender = $_POST['Gendertb'];
    $grade = $_POST['Gradetb'];
	$gpa = $_POST['GPAtb'];
	$classcount = $_POST['ClassCounttb'];
	$favsubject = $_POST['FavSubjecttb'];
    $favteach = $_POST['FavTeachertb'];
	$discipline = $_POST['DisciplineProbstb'];

	$sql = "INSERT INTO students (FName, LName, Age, Gender, Grade, GPA, ClassCount, FavSubject, FavTeacher, DisciplineProbs) 
            VALUES ('$fn', '$ln', '$age', '$gender', '$grade', '$gpa', '$classcount', '$favsubject', '$favteach', '$discipline')";
	$result = $conn->query($sql);

	if($result) {
	echo "Records inserted successfully";
	}
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 First Name : <input type ="text" name ="FNtb"/><br/><br/>
 Last Name : <input type="text" name="LNtb"/><br/><br/>
 Age : <input type ="text" name ="Agetb"/><br/><br/>
 Gender : <input type ="text" name ="Gendertb"/><br/><br/>
 Grade : <input type ="text" name ="Gradetb"/><br/><br/>
 GPA : <input type ="text" name ="GPAtb"/><br/><br/>
 ClassCount : <input type ="text" name ="ClassCounttb"/><br/><br/>
 FavSubject : <input type ="text" name ="FavSubjecttb"/><br/><br/>
 FavTeacher : <input type ="text" name ="FavTeachertb"/><br/><br/>
 DisciplineProbs : <input type ="text" name ="DisciplineProbstb"/><br/><br/>
 <input type ="submit" value="Insert" name="inserttb"/>
 </form>
 <!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>