<?php

// Author: Mark Pytel

$conn = mysql_connect("localhost", "root", "");
mysql_select_db("printstagram") or die(mysql_error());
if(isset($_GET['pid'])) {
$sql = "SELECT image FROM photo WHERE pid=" . $_GET['pid'];
$result = mysql_query("$sql") or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
$row = mysql_fetch_array($result);
header("content-type: image/jpeg");
echo $row["image"];
}
mysql_close($conn);
?>