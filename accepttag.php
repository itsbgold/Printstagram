<?php

// Author: Mark Pytel

session_start();


$myusername = $_SESSION['ses_username'];
// echo $myusername;


// echo $_GET['pidrow'];

$pidrow=$_GET['pidrow'];
//$tagger=$_SESSION['ses_tagger'];
//echo $tagger;

$conn = mysql_connect("localhost", "root", "");
mysql_select_db("printstagram");
$sql = "UPDATE tag SET tstatus=1 WHERE pid=$pidrow AND tstatus=0 AND taggee='$myusername'"; 
$result = mysql_query($sql);
?>
<HTML>
<HEAD>
Tag Accepted. Please hit your browser's back button to return to your profile.
</HEAD>
<BODY>

</BODY>
</HTML>