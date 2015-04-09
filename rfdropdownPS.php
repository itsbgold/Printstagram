<html>
<body>
<br>
<br>

<font size="5"><u>Remove Friend</u></font>
<br>
<br>

Select a friend from the box below.<br>
</body>
</html>



<?php

mysql_connect('localhost', 'root', '');
mysql_select_db('printstagram');

$mysqli = new mysqli("localhost", "root", "", "printstagram");

//$selrf = "SELECT distinct username FROM ingroup WHERE ownername='$myusername'";
$stmt=$mysqli->prepare("SELECT DISTINCT username from ingroup WHERE ownername='$myusername'");
$stmt->execute();
// $result = mysql_query($selrf);
$stmt->bind_result($username);

?>
<form name="form1" method="post" action="removefriendPSwT.php">
<form>
<?php

echo "<select name='remfname'>";

while ($stmt->fetch()) {
    echo "<option value='" . $username . "'>" . $username . "</option>";
}
echo "</select>";

?>


<input type="submit" name="Submit" value="Remove Friend">
</form>



<hr>
