<?php

include("config.php");
session_start();

//get post parameters

$user=$_POST['username'];
$old=sha1($_POST['oldpassword']);


//check session else redirect to login 

$check=$_SESSION['login_user'];
if($check==NULL)
{
	header("Location: /index.html");
}

//check values else redirect to settings page
if($check!=NULL && ($user==NULL || $old==NULL) )
{
header("Location: /settings.php");	
}


$sql="DELETE from user where username='$user' AND password='$old'";

echo $sql;
echo "</br>";

$result=mysqli_query($db, $sql) or die('Error querying database.');

if( mysqli_affected_rows($db)>0)
{
echo "<h2>Account Deleted successfully</h2>";
session_destroy();
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
<a href="/settings.php" > <h3> Go back </h3> </a>
</br>
<a href="/index.html" > <h3>Login page </h3> </a>
</body>
</html>
