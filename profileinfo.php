
<?php

// Author: Mark Pytel


// session_start();


$myusername = $_SESSION['ses_username'];
// echo $myusername;
// $myusername='AA';

$myusername = stripslashes($myusername);
$myusername = mysql_real_escape_string($myusername);

?>
<br>
<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="printstagram"; // Database name 
$tbl_name="photo"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// select photo.pid, poster, caption, pdate from ingroup natural join shared natural join photo where username ='AA'

$sql="SELECT pid, poster, caption, pdate FROM photo WHERE poster='$myusername' OR pid in (select pid from tag where taggee='$myusername') OR pid in (select pid from ingroup natural join shared where username='$myusername' and username != ownername) ORDER BY pdate desc";
$result=mysql_query($sql);


while($row = mysql_fetch_array($result))
{
echo "<hr>";       
echo "-Photo ID: " . $row["pid"].  " &nbsp;&nbsp;&nbsp;-Posted by: " . $row["poster"].   " &nbsp;&nbsp;&nbsp;-Caption: " . $row["caption"].  " &nbsp;&nbsp;&nbsp;-Photo Date/Time: " . $row["pdate"]."<br>";

$pidrow=($row["pid"]);
//echo $pidrow;


include "tag_photo2.php";

?>
</head>
<body>

<form action="listsingleREV.php?pidrow=<?php echo $pidrow; ?>" method="POST">
<input type="submit" id="pidrow" value="View this image" />
</form>
</body>
</html>

<?php

$sql3="select distinct taggee, fname, lname from tag natural join person where pid = $pidrow and taggee=username and tstatus=1";
$result3=mysql_query($sql3);

echo "<u>-Tagged in this Photo-</u>";
echo "<br>";

while($row = mysql_fetch_array($result3))
{
echo "Name: " . $row["fname"].   " " . $row["lname"]. "<br>";
}
echo "<br>";

$sql2="select pid, fname, lname, ctext from commenton natural join comment natural join person where pid = $pidrow";
$result2=mysql_query($sql2); 

echo "<u>-Commented on this Photo-</u>";
echo "<br>";

while($row = mysql_fetch_array($result2))
{
echo "Name: " . $row["fname"].   " " . $row["lname"]. " &nbsp;&nbsp;&nbsp;Comment: " . $row["ctext"]."<br>";
}


echo "<br>";

echo "<u>-Manage Tags-</u><br>";

$sql4 = "select * from tag where pid=$pidrow AND tstatus=0 AND taggee='$myusername'";
$result4=mysql_query($sql4);

while($row = mysql_fetch_array($result4))
{

//$_SESSION['ses_tagger']=$row["tagger"];
// echo $_SESSION['ses_tagger'];
echo "Username: " . $row["tagger"].   " wants to tag you in this photo." . "<br>";
?>
<div>
<form action="accepttag.php?pidrow=<?php echo $pidrow; ?>" method="POST"><input type="submit" id="pidrow" value="Accept" />
</form>
<form action="declinetag.php?pidrow=<?php echo $pidrow; ?>" method="POST"><input type="submit" id="pidrow" value="Decline" />
</form>
<form action="nochangetag.php?pidrow=<?php echo $pidrow; ?>" method="POST"><input type="submit" id="pidrow" value="I'll think about it" />
</form>
</div>


<?php

} 


echo "<br>";
// include "tag_post.php";
// include "tag_friend.php";
echo "<hr>";




}




?>

<html>
<body>



</body>
</html>