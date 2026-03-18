<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hogwarts_middle_school_performance_and_records_system";
$conn = new mysqli($servername, $username, $password, $dbname)or die("Connect failed: %s\n". $conn -> error)

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if($result->num_rows > 0){
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>UserID</th>
	    <th>Username</th>
	    <th>PasswordHash</th>
	    <th>Role</th>
        <th>ProfID</th>
    
	</tr>";
}
while ($row = $result -> fetch_assoc()){
	echo '<tr>
        <td> '.$row['UserID'].' </td>
        <td> '.$row['Username'].' </td>
        <td> '.$row['PasswordHash'].' </td>
        <td> '.$row['Role'].' </td>
        <td> '.$row['ProfID'].' </td>
	</tr>';	
}

echo "</table>";

if(isset($_POST['inserttb'])){ //things to do, once the "submit" key is hit

	$UserID = $_POST['UserIDtb'];//get form value UserID attribute
	$Username = $_POST['Usernametb'];//get form value Username attribute
    $PasswordHash=$_POST['PasswordHashtb'];//get form value ID attribute
    $Role = $_POST['Roleb'];//get form value Years Taught attribute
	$ProfID = $_POST['ProfIDtb'];//get form value Yearly Salary attribute
	$servername = "localhost";// sql server machine name/IP (if your computer is the server too, then just keep it as "localhost"). 
	$username = "root";// mysql username
	$password = "";// sql password
    $dbname = "hogwarts_middle_school_performance_and_records_system";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "INSERT INTO users VALUES ($UserID', '$Username', '$PasswordHash', '$Role', '$ProfID')";//embed insert statement in PHP
	$result = $conn->query($sql);

	if($result) //if the insert into database was successful
	{
	echo "Records inserted successfully";
	}
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" 
method="post">
 UserID : <input type ="text" name ="UserIDtb"/>
 Username : <input type ="text" name ="Usernametb"/>
 PasswordHash : <input type="text" name="PasswordHashtb"/> 
 Role : <input type ="text" name ="Roletb"/>
 ProfID : <input type ="text" name ="ProfIDtb"/>
 <input type ="submit" value="Insert" name="inserttb"/>
 </form>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<br/>	<!-- The <br> tag inserts a single line break.-->

<!-- Below, we define components exist in the page (textboxes and submit button) -->
UserID : <input type ="text" name ="UserIDtb"/>
<br/> <br/>
Username : <input type ="text" name ="Usernametb"/>
<br/> <br/>
PasswordHash : <input type="text" name="PasswordHashtb"/> 
<br/> <br/>
Role : <input type ="text" name ="Roletb"/>
<br/> <br/>
ProfID : <input type ="text" name ="ProfID"/>
<br/> <br/>
<input type ="submit" value="Insert" name="inserttb"/>
</form>
