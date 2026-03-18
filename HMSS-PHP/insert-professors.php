<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error);

$sql = "SELECT * FROM professors";
$result = $conn->query($sql);
if($result->num_rows > 0){
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
	</tr>';	
}

echo "</table>";

if(isset($_POST['inserttb'])){ //things to do, once the "submit" key is hit

	$fn = $_POST['FNtb'];//get form values First Name attribute
    $ln = $_POST['LNtb'];//get form value Last Name attribute
	$age = $_POST['Agetb'];//get form value Age attribute
    $gender = $_POST['Gendertb'];//get form value Gender attribute
	$subject = $_POST['Subjecttb'];//get form value Subject attribute
	$grade = $_POST['Gradetb'];//get form value Grade attribute
    $yt = $_POST['YearTeachtb'];//get form value Years Taught attribute
	$ys = $_POST['YearlySalarytb'];//get form value Yearly Salary attribute

	$sql = "INSERT INTO professors (FName, LName, Age, Gender, Subject, Grade, YearTeach, YearlySalary) 
	        VALUES ('$fn', '$ln', '$age', '$gender', '$subject', '$grade', '$yt', '$ys')";//embed insert statement in PHP
	$result = $conn->query($sql);

	if($result) //if the insert into database was successful
	{
	    echo "Records inserted successfully";
	} else {
	    echo "Error: " . $conn->error; // Added error reporting
	}
}
?>

<h3>Add New Professor</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 First Name : <input type="text" name="FNtb" required/><br/><br/>
 Last Name : <input type="text" name="LNtb" required/><br/><br/>
 Age : <input type="number" name="Agetb" required/><br/><br/>
 Gender : <input type="text" name="Gendertb" required/><br/><br/>
 Subject : <input type="text" name="Subjecttb" required/><br/><br/>
 Grade : <input type="number" name="Gradetb" min="1" max="8" required/><br/><br/>
 YearTeach : <input type="number" name="YearTeachtb" required/><br/><br/>
 YearlySalary : <input type="number" name="YearlySalarytb" required/><br/><br/>
 <input type="submit" value="Insert" name="inserttb"/>
 </form>
 <!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>
