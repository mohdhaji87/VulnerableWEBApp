<?php
include ("config.php");

$token=$_GET['token'];
$user=$_GET['user'];
$pass=mt_rand();

$query = "Update register set password='$pass' where username='$user'";
if (mysqli_query($db, $query)==1)
{

    echo 'Your new new password is   '.$pass;
}
else{
	echo "Error changing password";
}

?>