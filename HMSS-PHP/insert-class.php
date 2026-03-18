<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n". $conn -> error); // ADDED SEMICOLON

$sql = "SELECT * FROM class";
$result = $conn->query($sql);
if($result->num_rows > 0){
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>ClassID</th>
	    <th>Subject</th>
	    <th>Grade</th>
	    <th>ProfID</th>
	    <th>Difficulty</th>
        <th>SupplyFee</th>
	</tr>";
}
while ($row = $result -> fetch_assoc()){
	echo '<tr>
        <td> '.$row['ClassID'].' </td>
        <td> '.$row['Subject'].' </td>
        <td> '.$row['Grade'].' </td>
        <td> '.$row['ProfID'].' </td>
        <td> '.$row['Difficulty'].' </td>
        <td> '.$row['SupplyFee'].' </td>
	</tr>';	
}

echo "</table>";

if(isset($_POST['inserttb'])){ //things to do, once the "submit" key is hit

	$subject = $_POST['Subjecttb'];//get form value Subject attribute
	$grade = $_POST['Gradetb'];//get form value Grade attribute
    $profid = $_POST['ProfIDtb'];//get form value ProfID attribute
    $difficulty = $_POST['Difficultytb'];//get form value Difficulty attribute - FIXED VARIABLE NAME
	$supplyfee = $_POST['SupplyFeetb'];//get form value SupplyFee attribute - FIXED VARIABLE NAME
	$servername = "localhost";
	$username = "root";
	$password = "";
    $dbname = "hogwarts_middle_school_performance_and_records_system";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "INSERT INTO class (Subject, Grade, ProfID, Difficulty, SupplyFee) VALUES ('$subject', '$grade', '$profid', '$difficulty', '$supplyfee')"; // FIXED INSERT STATEMENT
	$result = $conn->query($sql);

	if($result) //if the insert into database was successful
	{
	echo "Records inserted successfully";
	} else {
	    echo "Error: " . $conn->error; // Added error reporting
	}
}
?>
<h3>Add New Class</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 Subject : <input type="text" name="Subjecttb" required/><br/><br/>
 Grade : <input type="number" name="Gradetb" min="1" max="8" required/><br/><br/>
 ProfID : <input type="number" name="ProfIDtb" required/><br/><br/>
 Difficulty : <input type="number" name="Difficultytb" min="1" max="10" required/><br/><br/>
 SupplyFee : <input type="number" name="SupplyFeetb" min="0" required/><br/><br/>
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