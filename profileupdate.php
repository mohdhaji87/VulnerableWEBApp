<?php
include("config.php");
session_start();
//get post parameters
$user=$_SESSION['login_user']; //getting username from session 
$em=$_POST['email'];

//check session else redirect to login page
$check=$_SESSION['login_user'];
if($check==NULL )
{
	header("Location: /index.html");
}

//check values else redirect to settings page
if($check!=NULL && ($em==NULL || $gen==NULL) )
{
header("Location: /settings.php");	
}



//update information

$sql="UPDATE user SET email='$em' where username='$user'";
$result=mysqli_query($db, $sql) or die('Error querying database.');

if( mysqli_affected_rows($db)>0)
{
	echo "</br>";
echo "<h2>Account updated successfully</h2>";
 }
 else {
	 echo "</br>";
    echo "<h2>No modification done to profile</h2>" ;

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
