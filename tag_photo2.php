<html>
<body>
<br>
<u>-Tag this photo-</u>

</body>
</html>



<?php

// Author: Mark Pytel

mysql_connect('localhost', 'root', '');
mysql_select_db('printstagram');

$mysqli = new mysqli("localhost", "root", "", "printstagram");

// echo $myusername;
// echo $pidrow;

// $pidrow = 1;
//$myusername = 'AA';

// session_start();

$_SESSION['ses_phototagid'] = $pidrow;

//echo $_SESSION['ses_phototagid'];
$_SESSION['ses_myusername'] = $myusername;

?>
<html>
<body>
<br>


Select a friend from the box below.<br>
</body>
</html>



<?php

//$selrf = "SELECT distinct username FROM ingroup WHERE ownername='$myusername'";
$stmt=$mysqli->prepare("SELECT DISTINCT username from ingroup WHERE ownername='$myusername'");
$stmt->execute();
// $result = mysql_query($selrf);
$stmt->bind_result($username);

?>

<form name="form1" method="post" action="tag_photo_action.php?pidrow=<?php echo $row["pid"]; ?>" method="post">
<form>
<?php

echo "<select name='tagfname'>";

while ($stmt->fetch()) {
    echo "<option value='" . $username . "'>" . $username . "</option>";
}
echo "</select>";

//echo $_SESSION['ses_phototagid'];

?>


<input type="submit" name="Submit" value="Tag this friend">
</form>




