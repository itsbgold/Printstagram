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
// echo $myusername;


$rf=$_POST['remfname'];
// echo $rf;

$rf = stripslashes($rf);
$rf = mysql_real_escape_string($rf);

// Delete friend

$sql="SELECT * FROM ingroup WHERE username='$rf' and ownername='$myusername'";
$result=mysql_query($sql);

while($row=mysql_fetch_array($result))
{    

$rfg=($row["gname"]);
// echo $rfg;

//$deletesql = "DELETE FROM ingroup WHERE ownername='$myusername' AND gname='$rfg' AND username='$rf'";
$stmt=$mysqli->prepare("DELETE FROM ingroup WHERE ownername=? AND gname=? AND username=?");

$stmt->bind_Param('sss', $myusername, $rfg, $rf);

//mysql_query($deletesql);
$stmt->execute();

}

// Delete tags

// Delete tags where the defriended person is tagged in the photos the defriender posted

$stmt=$mysqli->prepare("DELETE FROM tag WHERE taggee=? AND pid in (Select pid from photo where poster=?)");
$stmt->bind_Param('ss', $rf, $myusername);
$stmt->execute();

// Delete tags where the defriender is tagged in the photos the defriended posted

$stmt=$mysqli->prepare("DELETE FROM tag WHERE taggee=? AND pid in (Select pid from photo where poster=?)");
$stmt->bind_Param('ss', $myusername, $rf);
$stmt->execute();


// header("location:login_success.php");

echo "Friend successfully deleted, click your browsers back button to go back to your profile page.";





?>
