<?php

include("config.php");
session_start();

//get post parameters

$user=$_POST['username'];
$old=$_POST['oldpasswd'];


//check session else redirect to login 

$check=$_SESSION['login_user'];
if($check==NULL)
{
	header("Location: /vulnerable/index.html");
}

//check values else redirect to settings page
if($check!=NULL && ($user==NULL || $old==NULL) )
{
header("Location: /vulnerable/settings.php");	
}


$sql="DELETE from register where username='$user' AND password='$old'";

echo $sql;
echo "</br>";

$result=mysqli_query($db, $sql) or die('Error querying database.');

if( mysqli_affected_rows($db)>0)
{
echo "Account Deleted successfully";
session_destroy();
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
<a href="/vulnerable/settings.php" > <h3> Go back </h3> </a>
</br>
<a href="/vulnerable/index.html" > <h3>Login page </h3> </a>
</body>
</html>