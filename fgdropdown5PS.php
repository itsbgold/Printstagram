<html>
<body>
<font size = "5"><u>Add Friend</u></font>
<br>
<br>
Select a friendgroup from the box below.
<br>

</body>
</html>



<?php

// Author: Mark Pytel

mysql_connect('localhost', 'root', '');
mysql_select_db('printstagram');

$mysqli = new mysqli("localhost", "root", "", "printstagram");

// echo $myusername;

//$selfg = "SELECT ownername, gname, username FROM ingroup WHERE username='$myusername'";
$stmt=$mysqli->prepare("SELECT distinct gname from ingroup WHERE ownername='$myusername'");
$stmt->execute();
//$result = mysql_query($selfg);
$stmt->bind_result($gname);



?>
<form name="form1" method="post" action="checkfriend2PSwSC.php">
<form>
<?php

echo "<select name='gname'>";

while ($stmt->fetch()) {
    echo "<option value='" . $gname . "'>" . $gname . "</option>";
}
echo "</select>";

?>


<input name="checkfirst" type="text" id="checkfirst">Enter First Name</input>
<input name="checklast" type="text" id="checklast">Enter Last Name</input>
<input type="submit" name="Submit" value="Add Friend">

<br>
<br>
<hr>


</form>



