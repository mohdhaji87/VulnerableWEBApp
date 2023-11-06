

<html>
 <head>
 Register page
 </head>
 <body>
 

<?php
include("config.php");
//Step2
$a=$_POST['username'];
$b=sha1($_POST['password']);
$c=$_POST['email'];
$query = "insert into user (username, password, email) values ('$a', '$b','$c')";

echo "" . '<br />';

if((mysqli_query($db, $query))==1)
{
 echo '<h2>Successfully registered as </h2>'.$a.'<br />'; 
}
else
{
	echo '<h2>Username is taken or registration error</h2>';
}
//Step 4
mysqli_close($db);
?>

<a href="/index.html" >Go back </a>

<script>
if(top != window) {
  top.location = window.location
}

</script>
</body>
</html>
