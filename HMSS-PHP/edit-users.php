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


if (!empty($_GET['UserID'])){
    $UserID = $_GET['UserID']; //the value of pid is received from the editrecord.php page
    }
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname  = "hogwarts_middle_school_performance_and_records_system";
    
    // Create connection to database
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    //Things to do, after the "upPasswordHashbtn" button is clicked.
    if(isset($_POST['upPasswordHashbtn']))
    {

        
	$servername = "localhost";// sql server machine name/IP (if your computer is the server too, then just keep it as "localhost"). 
	$username = "root";// mysql username
	$password = "";// sql password
    $dbname = "hogwarts_middle_school_performance_and_records_system";
        $sql_upPasswordHash= "UPPasswordHash users SET  Username = '$_POST[Usernametb]', PasswordHash = '$_POST[PasswordHashtb]', Role = '$_POST[Roletb]', ProfID = '$_POST[ProfIDtb]'
 WHERE UserID='$UserID'";
    
        $resultupPasswordHash = $conn->query($sql_upPasswordHash);
    
        if($resultupPasswordHash) //if the upPasswordHash is done successfully
            {
            echo "Records upPasswordHashd successfully";
            }

    } else if (isset($_POST['deletebtn'])){
        if(isset($_GET['mode']) == 'delete'){
    
                //Things to do, after the "deletebtn" button is clicked.
    $sqldelete = "DELETE FROM users WHERE UserID='$UserID'";//delete statement
    $delete = $conn->query($sqldelete);//execute the query
    if($delete)
     { 
      echo "Record deleted successfully!";
     }
    }
    }
    
    //when the page is loaded (also after the upPasswordHash is effective), the information of the selected (upPasswordHashd) record is loaded
    $sql = "SELECT * FROM users WHERE UserID='$UserID'";
    $result = $conn->query($sql);


$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM users";// embed a select statement in php
$result = $conn->query($sql);// get result

if($result->num_rows > 0){// check for number of rows. If there are records, build a table to show them
 echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>UserID</th>
	    <th style='border: solid 1px black;'>Username</th>
        <th style='border: solid 1px black;'>PasswordHash</th>
	    <th style='border: solid 1px black;'>Role</th>
	    <th style='border: solid 1px black;'>ProfID</th>
	    <th style='border: solid 1px black;'>Edit</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){// Fetch the query result and store them in an array
	echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">'.$row['UserID'].'</td>
		<td style="border: solid 1px black;">'.$row['Username'].'</td>
        <td style="border: solid 1px black;">'.$row['PasswordHash'].'</td>		
		<td style="border: solid 1px black;">'.$row['Role'].'</td>
		<td style="border: solid 1px black;">'.$row['ProfID'].'</td>


<!-- the core edit operation is done in edit.php. Here, we create only a hyperlink and send parameters to edit.php -->		
<!--For each row of the table, we create a hyperlink and include the parameter UserID to be used it in the destination page (edit.php)-->
		<td style="border: solid 1px black;"> <a href="edit-users.php?UserID='.$row['UserID'].'">Click </a></td>
		</tr>';
}
 
echo "</table>";    
    
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" 
method="post">
 UserID : <input type ="text" name ="UserIDtb"/>
 Username : <input type ="text" name ="Usernametb"/>
 PasswordHash : <input type="text" name="PasswordHashtb"/> 
 Role : <input type ="text" name ="Roletb"/>
 ProfID : <input type ="text" name ="ProfIDtb"/>
 <input type ="submit" value="Edit" name="Edittb"/>
 </form>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<br/>	<!-- The <br> tag Edits a single line break.-->

<!-- Below, we define components exist in the page (textboxes and submit button) -->
UserID : <input type ="text" name ="UserIDtb"/>
<br/> <br/>
Username : <input type ="text" name ="Usernametb"/>
<br/> <br/>
PasswordHash : <input type="text" name="IDtb"/> 
<br/> <br/>
Role : <input type ="text" name ="Roletb"/>
<br/> <br/>
ProfID : <input type ="text" name ="ProfIDb"/>
<br/> <br/>
<input type ="submit" value="Edit" name="edittb"/>
</form>
<!-- Back to Dashboard Button -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>
