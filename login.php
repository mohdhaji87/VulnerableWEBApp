

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
$b=sha1($_POST['password']);
$query = "select * from user where username='$a' AND password='$b' AND isActive='0'";

$result=mysqli_query($db, $query) or die('Error querying database.');

//fetch from database


if($row = mysqli_fetch_array($result)) {
 $_SESSION['login_user']=$row["username"];
  header("Location: /settings.php");
}
else
{
	echo 'Unauthorized';
	header("Location: /index.html");
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
