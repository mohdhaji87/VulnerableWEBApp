<?php
include("config.php");
session_start();

//get post parameters

$user=$_POST['username'];
$old=$_POST['oldpasswd'];
$new=$_POST['newpasswd'];


//check session else redirect to login page
$check=$_SESSION['login_user'];
if($check==NULL)
{
	header("Location: /vulnerable/index.html");
}

//check values else redirect to settings page
if($check!=NULL && ($user==NULL || $old==NULL || $new==NULL) )
{
header("Location: /vulnerable/settings.php");	
}




//update password 

$sql="UPDATE register set password='$new' where username='$user' AND password='$old'";

echo $sql;
echo "</br>";

$result=mysqli_query($db, $sql) or die('Error querying database.');

if( mysqli_affected_rows($db)>0)
{
echo "Password updated successfully";
}
else {
	echo "Incorrect Password";
}


mysqli_close($db);


?>

<html>
<body>
</br>

<script>
if(top != window) {
  top.location = window.location
}

</script>
<a href="/vulnerable/settings.php" > <h3>Go back</h3> </a>
</body>
</html>
