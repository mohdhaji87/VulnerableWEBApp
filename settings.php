<?php 
include("config.php");
session_start();
//get username of logged in user
$check=$_SESSION['login_user'];
if($check==NULL)
{
	header("Location: /vulnerable/index.html");
}
$sql="select username ,email,gender from register where username='$check'";
$result=mysqli_query($db, $sql) or die('Error querying database.');
//fetch values from database
 if($row = mysqli_fetch_array($result)) {
	$a=$row["username"];
}
?>
<html>
<body>
<h1>Welcome <?php echo $a; ?></h1>
<h2>Profile setting</h2>
<form action="Profileupdate.php" method="POST" >
Username : <input type="text" name="username" disabled="" value="<?php echo $a; ?>"/> </br>
Email : <input type="email" name="email" value="<?php echo $row["email"]; ?>"></br>
Gender : <input type="radio" name="gender" value="male"> Male <input type="radio" name="gender" value="female"> Female </br>
<input type="submit" name="update" value="update">
</form>

</br>
<h2> Change password </h2>
<form action="changepasswd.php" method="POST">
Username : <input type="hidden" name="username"  value="<?php echo $a ;?>" </br>
Old Password : <input type="text" name="oldpasswd" value="" > </br>
New Password : <input type="text" name="newpasswd" value="" > </br>
<input type="submit" name="update" value="update">
</form>

</br>
<h2> Delete account </h2>

<form action="deleteaccount.php" method="POST">
Username : <input type="hidden" name="username"  value="<?php echo $a ;?>" </br>
Old Password : <input type="text" name="oldpasswd" value="" > </br>
<input type="submit" name="update" value="update">
</form>

<h2> Ping website </h2>
<form action="pingurl.php" method="POST">
Enter Url : <input text="text" name="url" value=""></br>
<input type="submit" name="submit" value="ping">
</form>
</br>


</br>
<h2 > Terms of Service </h2>
<a href="tos.php?file=service.html" >Click here </a>

</br>
</br>
</br>

<a href="logout.php" >Logout</a>
<script>
if(top != window) {
  top.location = window.location
}

</script>
</body>
</html>
