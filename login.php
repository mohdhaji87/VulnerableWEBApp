

<html>
 <head>
 testpage
 </head>
 <body>
 

<?php
include("config.php");
session_start();
//get user input
$a=$_POST['username'];
$b=$_POST['passwd'];
$query = "select * from register where username='$a' AND password='$b'";

$result=mysqli_query($db, $query) or die('Error querying database.');

//fetch from database


if($row = mysqli_fetch_array($result)) {
 $_SESSION['login_user']=$row["username"];
  header("Location: /vulnerable/settings.php");
}
else
{
	echo 'not auhorized';
	header("Location: /vulnerable/index.html");
}
//close database
mysqli_close($db);
?>
<script>
if(top != window) {
  top.location = window.location
}

</script>
</body>
</html>