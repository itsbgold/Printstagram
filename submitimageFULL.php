<?php

// Author: Mark Pytel

session_start();


$myusername = $_SESSION['ses_username'];
//CHANGE BACK TO ABOVE
//$myusername='AA';


mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("printstagram") or die(mysql_error());

$sql = "Select * from photo";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	$newpid = $count + 1;

if(!isset($_FILES['image']))
{
echo 'Please select an image.';
}
else {

$captionform=$_POST['captionform']; 
$captionform = stripslashes($captionform);
$captionform = mysql_real_escape_string($captionform);

$puborpriv=$_POST['puborpriv'];
//echo $puborpriv;

$gnshared=$_POST['gnshared'];
//echo $gnshared;

if($puborpriv=='public')
{
$ispub=1;
//echo $puborpriv;
}
if($puborpriv=='private')
{

$ispub=0;
}



$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
//echo $_FILES['image']['tmp_name'];
$image_name = addslashes($_FILES['image']['name']);
$image_size = getimagesize($_FILES['image']['tmp_name']);

if($image_size==FALSE){
echo "That's not an image.";
} else {
if(!$insert = mysql_query("INSERT INTO photo VALUES ($newpid, '$myusername', '$captionform', CURRENT_TIMESTAMP, NULL, NULL, NULL, $ispub, '$image')"))
     {
 echo "Problem uploading image.";
 } else {

if($ispub==0)
{
$insertshared="INSERT INTO shared VALUES ($newpid, '$gnshared', '$myusername')";
mysql_query($insertshared);
//echo 'Item added to shared relation';
} 

  echo "Image uploaded.";
  }
}

  }
?>
<br>
<br>
</body>
</html>