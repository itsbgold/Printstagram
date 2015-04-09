<html>
<body>


<br>
<font size="7">Welcome to Printstagram!</font>
<br>
<br>
<font size="5"><u>Photos, Tags, and Comments</u></font>
<br>

</body>
</html>


<?php

// Author: Mark Pytel


session_start();


$myusername = $_SESSION['ses_username'];
//echo $myusername;
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

include "profileinfo.php";

include "imagehtmlFULL.php";

include "fgdropdown5PS.php";

include "rfdropdownPS.php";

include "gallery.php";

?>

