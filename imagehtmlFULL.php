<html>
<head>
</head>
<body>
<br>
<br>
<font size = "5"><u>Upload Image</u></font>
<br>
<br>
<form action="submitimageFULL.php" method="POST" enctype="multipart/form-data">
File: <input type="file" name="image" /><input type="submit" value="Upload" />
<br>
<br>

<input name="captionform" type="text" id="captionform">Enter Caption</input>

<br>
<br>
Set Photo to Public or Private. If Photo is Private Select Friendgroup to Share it With.
<br>
<br>

<select name='puborpriv'>

<option value='public'>Public</option>
<option value='private'>Private</option>

</select>


<?php

// Author: Mark Pytel

mysql_connect('localhost', 'root', '');
mysql_select_db('printstagram');

$mysqli = new mysqli("localhost", "root", "", "printstagram");

// echo $myusername;

//$selfg = "SELECT ownername, gname, username FROM ingroup WHERE username='$myusername'";
$stmt=$mysqli->prepare("SELECT gname from ingroup WHERE username='$myusername'");  //CHANGE BACK TO MYUSERNAME
$stmt->execute();
//$result = mysql_query($selfg);
$stmt->bind_result($gname);

echo "<select name='gnshared'>";

while ($stmt->fetch()) {
    echo "<option value='" . $gname . "'>" . $gname . "</option>";
}
echo "</select>";
echo "<br>";
echo "<br>";
echo "<hr>";

?>






</form>
<br>
<br>
</body>
</html>