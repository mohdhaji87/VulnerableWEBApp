<?php
include("config.php");
session_start();

//get post parameters

$user=$_POST['username'];
$old=sha1($_POST['oldpassword']);
$new=sha1($_POST['newpassword']);


//check session else redirect to login page
$check=$_SESSION['login_user'];
if($check==NULL)
{
	header("Location: /index.html");
}

//check values else redirect to settings page
if($check!=NULL && ($user==NULL || $old==NULL || $new==NULL) )
{
header("Location: /settings.php");	
}




//update password 

$sql="UPDATE user set password='$new' where username='$user' AND password='$old'";
$result=mysqli_query($db, $sql) or die('Error querying database.');

if( mysqli_affected_rows($db)>0)
{
echo "<h2>Password updated successfully</h2>";
}
else {
	echo "<h2>Incorrect Password</h2>";
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
<a href="/settings.php" > <h3>Go back</h3> </a>
</body>
</html>
