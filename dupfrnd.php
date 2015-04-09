<?php

// Author: Mark Pytel

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="printstagram"; // Database name 
$tbl_name="person"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$mysqli = new mysqli("localhost", "root", "", "printstagram");

session_start();

$onforinsert = $_SESSION['ses_onforinsert'];
$fg = $_SESSION['ses_fg'];
$unforinsert=$_POST['undupfrnd'];



$stmt = $mysqli->prepare("INSERT INTO ingroup VALUES (?, ?, ?)");

$stmt->bind_Param('sss', $onforinsert, $fg, $unforinsert);

// mysql_query($insertsql);
$stmt->execute();

// header("location:login_success.php");

echo "Friend successfully added, click your browsers back button twice to go back to your profile page.";





?>