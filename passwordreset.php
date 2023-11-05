<?php
include ("config.php");

$token=$_GET['token'];
$user=$_GET['user'];
$pass=mt_rand();
$hash=sha1($pass);

$query = "Update user set password='$hash' where username='$user'";
if (mysqli_query($db, $query)==1)
{

    echo 'Your new password is   '.$pass;
}
else{
	echo "Error changing password";
}

?>
