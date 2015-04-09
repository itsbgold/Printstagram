<?php

// Author: Mark Pytel

session_start();


$myusername = $_SESSION['ses_username'];
//echo $myusername;

$conn = mysql_connect("localhost", "root", "");
mysql_select_db("printstagram");
$sql = "SELECT pid FROM photo WHERE poster='$myusername' OR pid in (select pid from tag where taggee='$myusername') OR pid in (select pid from ingroup natural join shared where username='$myusername' and username != ownername) order by pdate desc"; 
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