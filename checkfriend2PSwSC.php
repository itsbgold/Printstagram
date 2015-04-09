<?php

// Author: Mark Pytel


$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="printstagram"; // Database name 
$tbl_name="person"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$mysqli = new mysqli("localhost", "root", "", "printstagram");

session_start();
$myusername = $_SESSION['ses_username'];
// echo $myusername;

$checkfirst=$_POST['checkfirst']; 
$checklast=$_POST['checklast']; 
$fg=$_POST['gname'];

// Guard against SQL injection by stripping any inappropriate characters from variables that go into sql statement below
$checkfirst = stripslashes($checkfirst);
$checklast = stripslashes($checklast);
$fg = stripslashes($fg);
$checkfirst = mysql_real_escape_string($checkfirst);
$checklast = mysql_real_escape_string($checklast);
$fg = mysql_real_escape_string($fg);


$sql="SELECT * FROM person WHERE fname='$checkfirst' and lname='$checklast'";
$result=mysql_query($sql);

$onforinsert=$myusername;

//$sql2="SELECT * FROM ingroup WHERE gname='$fg' AND username='$myusername'";
// Use prepared statements to guard against SQL injection
//$stmt=$mysqli->prepare("Select ownername from ingroup WHERE gname='$fg' and username='$myusername'");
//$stmt->execute();
//$stmt->bind_result($onforinsert); 


//$result2=mysql_query($sql2);

//$row2 = mysql_fetch_array($result2);

//$onforinsert=($row2["ownername"]);
//while($stmt->fetch()){
//echo $onforinsert;
//}

$row = mysql_fetch_array($result);
    
$unforinsert=($row["username"]);
// echo $unforinsert;

$sql3="Select * from ingroup where ownername='$myusername' and gname='$fg' and username='$unforinsert'";
$result3=mysql_query($sql3);
$count3=mysql_num_rows($result3);
// echo $count3;
// $count=mysql_num_rows($result);

if($count3==1)
{

echo "This person is already in that friendgroup.";

}

else
{



// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{


// session_start();
// $_SESSION['ses_username'] = $myusername;

// Commented out below because $unforinsert was already instantiated and this code broke the function instantiating it again

//$row = mysql_fetch_array($result);
//$unforinsert=($row["username"]);
//echo $unforinsert;

// $insertsql = "INSERT INTO ingroup (ownername, gname, username) VALUES ( '$onforinsert' , '$fg', '$unforinsert' )";

$stmt = $mysqli->prepare("INSERT INTO ingroup VALUES (?, ?, ?)");

$stmt->bind_Param('sss', $onforinsert, $fg, $unforinsert);

// mysql_query($insertsql);
$stmt->execute();

// header("location:login_success.php");

echo "Friend successfully added, click your browsers back button to go back to your profile page.";

}
else
{

if($count==2)
{
$_SESSION['ses_onforinsert'] = $onforinsert;
$_SESSION['ses_fg'] = $fg;

echo "There are two or more people with this name";
echo "<br>";
echo "Select your friends username";

$stmt=$mysqli->prepare("SELECT username from person WHERE fname='$checkfirst' and lname='$checklast'");
$stmt->execute();
//$result = mysql_query($selfg);
$stmt->bind_result($undupfrnd);
?>
<form name="form1" method="post" action="dupfrnd.php">
<form>
<?php

echo "<select name='undupfrnd'>";

while ($stmt->fetch()) {
    echo "<option value='" . $undupfrnd . "'>" . $undupfrnd . "</option>";
}
echo "</select>";

?>
<input type="submit" name="Submit" value="Add Friend">
</form>
<?php


}

else
{
echo "Person not found.";
}

}


}



?>
