<?php


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
// $pidrow2 = $_SESSION['ses_phototagid'];
$pidrow2 = $_GET['pidrow'];
//echo $myusername;
//echo $pidrow2;

$tagger=$_SESSION['ses_tagger'];
$tf=$_POST['tagfname'];
//echo $tf;

$tf = stripslashes($tf);
$tf = mysql_real_escape_string($tf);


// Delete tags

// Delete tags where the defriended person is tagged in the photos the defriender posted

if($tf==$myusername)
{
$visible = 1;
//echo $visible;
$stmt=$mysqli->prepare("INSERT INTO tag VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?)");
$stmt->bind_Param('isss', $pidrow2, $myusername, $tf, $visible);
$stmt->execute();
}
else
{
$visible = 0;
//echo $visible;
$stmt=$mysqli->prepare("INSERT INTO tag VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?)");
$stmt->bind_Param('isss', $pidrow2, $myusername, $tf, $visible);
$stmt->execute();
}

// header("location:login_success.php");

echo "Tag successfully added, click your browsers back button to go back to your profile page.";





?>
