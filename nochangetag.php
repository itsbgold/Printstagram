<?php

// Author: Mark Pytel

session_start();


$myusername = $_SESSION['ses_username'];
// echo $myusername;


// echo $_GET['pidrow'];

$pidrow=$_GET['pidrow'];

$conn = mysql_connect("localhost", "root", "");
mysql_select_db("printstagram");
//$sql = "UPDATE tag SET tstatus=0 WHERE pid=$pidrow AND tstatus=0 AND taggee='$myusername'"; 
//$result = mysql_query($sql);
?>
<HTML>
<HEAD>
No change to tag. Please hit your browser's back button to return to your profile.
</HEAD>
<BODY>

</BODY>
</HTML>