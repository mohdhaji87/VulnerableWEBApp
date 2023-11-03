<?php 
include("config.php");
session_start();
//get username of logged in user
$check=$_SESSION['login_user'];
if($check==NULL)
{
	header("Location: /index.html");
}
$sql="select username,email from user where username='$check'";
$result=mysqli_query($db, $sql) or die('Error querying database.');
//fetch values from database
 if($row = mysqli_fetch_array($result)) {
	$a=$row["username"];
}
?>
<html>
<body>
<h1>Welcome <?php echo $a; ?></h1>
	<center>
<h2>Profile picture</h2>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
<input type="file" name="pictures" accept="image/*"/>
<input type="submit" value="upload"/>
</form>

<?php
include("config.php");
session_start();
//get username of logged in user
$check=$_SESSION['login_user'];
require_once  "/bulletproof.php";

$image = new Bulletproof\Image($_FILES);

// To provide a name for the image. If unused, image name will be auto-generated.
$image->setName($check);

// To set the min/max image size to upload (in bytes)
$image->setSize(5000, 10000);

// To define a list of allowed image types to upload
$image->setMime(array('jpeg', 'gif'));

// To set the max image height/width to upload (limit in pixels)
$image->setDimension(128, 128);

// To create a folder name to store the uploaded image, with optional chmod permission
$image->setStorage('/avatars/'.$check, 600);

if($image["pictures"]){
  $upload = $image->upload(); 

  if($upload){
    echo $upload->getPath(); // uploads/cat.gif
  }else{
    echo $image->getError(); 
  }
}
?>
		
<h2>Profile settings</h2>
<form action="profileupdate.php" method="POST">
Username : <input type="text" name="username" disabled="" value="<?php echo $a; ?>"/> </br>
Email : <input type="email" name="email" value="<?php echo $row["email"]; ?>"></br>
<input type="submit" name="update" value="update">
</form>

</br>
<h2> Change password </h2>
<form action="changepassword.php" method="POST">
Username : <input type="hidden" name="username"  value="<?php echo $a ;?>" </br>
Old Password : <input type="text" name="oldpassword" value="" > </br>
New Password : <input type="text" name="newpassword" value="" > </br>
<input type="submit" name="update" value="update">
</form>

</br>
<h2> Delete account </h2>
<form action="deleteaccount.php" method="POST">
Username : <input type="hidden" name="username"  value="<?php echo $a ;?>" </br>
Old Password : <input type="text" name="oldpassword" value="" > </br>
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
</center>


<script>
if(top != window) {
  top.location = window.location
}

</script>
</body>
</html>
