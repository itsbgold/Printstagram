<?php

// Author: Mark Pytel

session_start();


//$myusername = $_SESSION['ses_username'];
//echo $myusername;


// echo $_GET['pidrow'];

$pidrow=$_GET['pidrow'];

$conn = mysql_connect("localhost", "root", "");
mysql_select_db("printstagram");
$sql = "SELECT pid FROM photo WHERE pid=$pidrow"; 
$result = mysql_query($sql);
?>
<HTML>
<HEAD>


</HEAD>
<BODY>
<?php
while($row = mysql_fetch_array($result)) {
?>
<img src="imageview.php?pid=<?php echo $row["pid"]; ?>" /><br/>
<?php		
}
mysql_close($conn);
?>
</BODY>
</HTML>