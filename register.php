

<html>
 <head>
 Register page
 </head>
 <body>
 

<?php
include("config.php");
//Step2
$a=$_POST['username'];
$b=$_POST['passwd'];
$c=$_POST['email'];
$d=$_POST['gender'];
$query = "insert into register values('$a','$b','$c','$d')";

echo "" . '<br />';

if((mysqli_query($db, $query))==1)
{
 echo '<h2>sucessfully registerd as </h2>'.$a.'<br />'; 
}
else
{
	echo '<h2>Username is taken or registration error</h2>';
}
//Step 4
mysqli_close($db);
?>

<a href="/vulnerable/index.html" >Go back </a>

<script>
if(top != window) {
  top.location = window.location
}

</script>
</body>
</html>
