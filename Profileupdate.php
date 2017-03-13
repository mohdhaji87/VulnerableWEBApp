<?php
include("config.php");
session_start();
//get post parameters
$user=$_SESSION['login_user']; //getting username from session 
$em=$_POST['email'];
$gen=$_POST['gender'];

//check session else redirect to login page
$check=$_SESSION['login_user'];
if($check==NULL )
{
	header("Location: /vulnerable/index.html");
}

//check values else redirect to settings page
if($check!=NULL && ($em==NULL || $gen==NULL) )
{
header("Location: /vulnerable/settings.php");	
}



//update information

$sql="UPDATE register SET  email='$em', gender='$gen' where username='$user'";
echo $sql;
$result=mysqli_query($db, $sql) or die('Error querying database.');

if( mysqli_affected_rows($db)>0)
{
	echo "</br>";
echo "Account updated successfully";
 }
 else {
	 echo "</br>";
    echo "No modification done to profile" ;

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
